<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TestAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'test_version_id',
        'attempt_token',
        'started_at',
        'completed_at',
        'time_taken',
        'score',
        'percentage',
        'total_questions',
        'correct_answers',
        'incorrect_answers',
        'unanswered',
        'current_section_index',
        'status',
        'passed',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'passed' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($attempt) {
            if (empty($attempt->attempt_token)) {
                $attempt->attempt_token = Str::random(64);
            }
        });
    }

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }

    public function testVersion(): BelongsTo
    {
        return $this->belongsTo(TestVersion::class);
    }

    public function sectionAttempts(): HasMany
    {
        return $this->hasMany(SectionAttempt::class)->orderBy('section_order');
    }

    public function questionAssignments(): HasMany
    {
        return $this->hasMany(QuestionAssignment::class);
    }

    public function candidateAnswers(): HasMany
    {
        return $this->hasMany(CandidateAnswer::class);
    }

    public function answers(): HasMany
    {
        return $this->candidateAnswers();
    }

    /**
     * Calculate and update the score
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

        $percentage = $totalMarks > 0 ? ($earnedMarks / $totalMarks) * 100 : 0;
        $passed = $percentage >= $this->testVersion->pass_threshold;

        $this->update([
            'score' => $earnedMarks,
            'percentage' => round($percentage, 2),
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'incorrect_answers' => $incorrectAnswers,
            'unanswered' => $unanswered,
            'passed' => $passed,
        ]);

        // Calculate section-wise scores
        foreach ($this->sectionAttempts as $sectionAttempt) {
            $sectionAttempt->calculateScore();
        }
    }

    /**
     * Get current section
     */
    public function getCurrentSection()
    {
        return $this->sectionAttempts()
            ->where('section_order', $this->current_section_index)
            ->first();
    }

    /**
     * Move to next section
     */
    public function moveToNextSection(): bool
    {
        $nextIndex = $this->current_section_index + 1;
        $nextSection = $this->sectionAttempts()
            ->where('section_order', $nextIndex)
            ->first();

        if ($nextSection) {
            $this->update(['current_section_index' => $nextIndex]);
            return true;
        }

        return false;
    }
}
