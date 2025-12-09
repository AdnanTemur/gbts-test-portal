<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandidateAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_attempt_id',
        'section_attempt_id',
        'question_id',
        'selected_option_id',
        'matching_answers',
        'is_correct',
        'time_spent',
    ];

    protected $casts = [
        'matching_answers' => 'array',
        'is_correct' => 'boolean',
    ];

    public function testAttempt(): BelongsTo
    {
        return $this->belongsTo(TestAttempt::class);
    }

    public function sectionAttempt(): BelongsTo
    {
        return $this->belongsTo(SectionAttempt::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function selectedOption(): BelongsTo
    {
        return $this->belongsTo(QuestionOption::class, 'selected_option_id');
    }
}
