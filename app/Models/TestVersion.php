<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TestVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'version_code',
        'title',
        'description',
        'section_time_limit',
        'questions_per_section',
        'expected_candidates',
        'overlap_threshold',
        'pass_threshold',
        'status',
        'shuffle_questions',
        'shuffle_options',
    ];

    protected $casts = [
        'shuffle_questions' => 'boolean',
        'shuffle_options' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($version) {
            if (empty($version->version_code)) {
                $version->version_code = self::generateVersionCode();
            }
        });
    }

    public static function generateVersionCode(): string
    {
        $date = now()->format('Ymd');
        $time = now()->format('His');
        $number = str_pad(self::whereDate('created_at', today())->count() + 1, 3, '0', STR_PAD_LEFT);

        return "TEST-V{$number}-{$date}-{$time}";
    }

    public function testSections(): BelongsToMany
    {
        return $this->belongsToMany(TestSection::class, 'version_sections')
            ->withPivot('section_order')
            ->orderBy('version_sections.section_order');
    }

    public function testAttempts(): HasMany
    {
        return $this->hasMany(TestAttempt::class);
    }

    public function completedAttempts(): HasMany
    {
        return $this->hasMany(TestAttempt::class)->where('status', 'completed');
    }

    /**
     * Calculate distribution metrics
     */
    public function calculateDistributionMetrics()
    {
        $metrics = [];

        foreach ($this->testSections as $section) {
            $totalQuestions = $section->activeQuestions()->count();
            $questionsNeeded = $this->questions_per_section * $this->expected_candidates;

            $sectionMetrics = [
                'total_questions' => $totalQuestions,
                'questions_needed' => $questionsNeeded,
            ];

            if ($totalQuestions >= $questionsNeeded) {
                // Can provide unique questions for all candidates
                $sectionMetrics['is_valid'] = true;
                $sectionMetrics['overlap_percentage'] = 0;
                $sectionMetrics['message'] = 'Sufficient questions for unique sets';
            } else {
                // Will have overlap
                $uniqueCandidates = floor($totalQuestions / $this->questions_per_section);
                $overlapPercentage = (($questionsNeeded - $totalQuestions) / $questionsNeeded) * 100;

                $sectionMetrics['is_valid'] = $overlapPercentage <= $this->overlap_threshold;
                $sectionMetrics['overlap_percentage'] = round($overlapPercentage, 2);
                $sectionMetrics['unique_candidates'] = $uniqueCandidates;
                $sectionMetrics['message'] = $sectionMetrics['is_valid']
                    ? "Acceptable overlap: {$sectionMetrics['overlap_percentage']}%"
                    : "High overlap: {$sectionMetrics['overlap_percentage']}% (threshold: {$this->overlap_threshold}%)";
            }

            $metrics[$section->name] = $sectionMetrics;
        }

        return $metrics;
    }
}
