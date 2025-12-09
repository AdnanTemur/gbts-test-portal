<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_attempt_id',
        'section_attempt_id',
        'question_id',
        'display_order',
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
}
