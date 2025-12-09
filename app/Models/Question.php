<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_section_id',
        'question_type',
        'question_text',
        'question_image',
        'difficulty_level',
        'marks',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function testSection(): BelongsTo
    {
        return $this->belongsTo(TestSection::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(QuestionOption::class)->orderBy('display_order');
    }

    public function matchingPairs(): HasMany
    {
        return $this->hasMany(MatchingPair::class)->orderBy('pair_order');
    }

    public function correctOption()
    {
        return $this->hasOne(QuestionOption::class)->where('is_correct', true);
    }

    public function isMCQ(): bool
    {
        return $this->question_type === 'mcq';
    }

    public function isTrueFalse(): bool
    {
        return $this->question_type === 'true_false';
    }

    public function isMatching(): bool
    {
        return $this->question_type === 'matching';
    }
}
