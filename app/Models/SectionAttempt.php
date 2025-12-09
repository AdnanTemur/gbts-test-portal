<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SectionAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_attempt_id',
        'test_section_id',
        'section_order',
        'started_at',
        'completed_at',
        'time_taken',
        'score',
        'total_questions',
        'correct_answers',
        'incorrect_answers',
        'unanswered',
        'status',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function testAttempt(): BelongsTo
    {
        return $this->belongsTo(TestAttempt::class);
    }

    public function testSection(): BelongsTo
    {
        return $this->belongsTo(TestSection::class);
    }

    public function questionAssignments(): HasMany
    {
        return $this->hasMany(QuestionAssignment::class);
    }

    public function candidateAnswers(): HasMany
    {
        return $this->hasMany(CandidateAnswer::class);
    }

    /**
     * Calculate section score
     */
    public function calculateScore(): void
    {
        $totalQuestions = $this->questionAssignments()->count();
        $correctAnswers = $this->candidateAnswers()->where('is_correct', true)->count();
        $answeredCount = $this->candidateAnswers()->whereNotNull('selected_option_id')
            ->orWhereNotNull('matching_answers')->count();
        $incorrectAnswers = $answeredCount - $correctAnswers;
        $unanswered = $totalQuestions - $answeredCount;

        $totalMarks = $this->questionAssignments()
            ->join('questions', 'questions.id', '=', 'question_assignments.question_id')
            ->sum('questions.marks');

        $earnedMarks = $this->candidateAnswers()
            ->where('is_correct', true)
            ->join('questions', 'questions.id', '=', 'candidate_answers.question_id')
            ->sum('questions.marks');

        $this->update([
            'score' => $earnedMarks,
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'incorrect_answers' => $incorrectAnswers,
            'unanswered' => $unanswered,
        ]);
    }

    /**
     * Check if section time has expired
     */
    public function hasExpired(): bool
    {
        if (!$this->started_at || $this->status === 'completed') {
            return false;
        }

        $timeLimit = $this->testAttempt->testVersion->section_time_limit;
        $endTime = $this->started_at->addMinutes($timeLimit);

        return now()->greaterThan($endTime);
    }
}
