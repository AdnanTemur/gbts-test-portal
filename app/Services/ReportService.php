<?php

namespace App\Services;

use App\Models\SectionAttempt;
use App\Models\TestSection;
use App\Models\TestVersion;
use App\Models\TestAttempt;
use App\Models\Candidate;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Get candidate-wise report
     */
    public function getCandidateReport($candidateId)
    {
        $candidate = Candidate::with([
            'testAttempts.testVersion',
            'testAttempts.sectionAttempts.testSection'
        ])->findOrFail($candidateId);

        $attempts = $candidate->testAttempts()
            ->where('status', 'completed')
            ->orderBy('completed_at', 'desc')
            ->get();

        return [
            'candidate' => $candidate,
            'attempts' => $attempts,
            'total_attempts' => $attempts->count(),
            'best_score' => $attempts->max('percentage'),
            'average_score' => $attempts->avg('percentage'),
            'latest_attempt' => $attempts->first(),
        ];
    }

    /**
     * Get category-wise report
     */
    // public function getCategoryReport($testVersionId = null)
    // {
    //     $query = TestAttempt::where('status', 'completed');

    //     if ($testVersionId) {
    //         $query->where('test_version_id', $testVersionId);
    //     }

    //     $attempts = $query->with('sectionAttempts.testSection')->get();

    //     $sections = [];
    //     foreach ($attempts->first()->sectionAttempts ?? [] as $sectionAttempt) {
    //         $sectionId = $sectionAttempt->test_section_id;
    //         $sectionName = $sectionAttempt->testSection->name;

    //         if (!isset($sections[$sectionId])) {
    //             $sections[$sectionId] = [
    //                 'name' => $sectionName,
    //                 'total_attempts' => 0,
    //                 'total_questions' => 0,
    //                 'total_correct' => 0,
    //                 'average_percentage' => 0,
    //             ];
    //         }

    //         foreach ($attempts as $attempt) {
    //             $sectionData = $attempt->sectionAttempts()
    //                 ->where('test_section_id', $sectionId)
    //                 ->first();

    //             if ($sectionData) {
    //                 $sections[$sectionId]['total_attempts']++;
    //                 $sections[$sectionId]['total_questions'] += $sectionData->total_questions;
    //                 $sections[$sectionId]['total_correct'] += $sectionData->correct_answers;
    //             }
    //         }

    //         if ($sections[$sectionId]['total_questions'] > 0) {
    //             $sections[$sectionId]['average_percentage'] = round(
    //                 ($sections[$sectionId]['total_correct'] / $sections[$sectionId]['total_questions']) * 100,
    //                 2
    //             );
    //         }
    //     }

    //     // Get most missed questions per section
    //     $missedQuestions = $this->getMostMissedQuestions($testVersionId);

    //     return [
    //         'sections' => array_values($sections),
    //         'missed_questions' => $missedQuestions,
    //     ];
    // }

    /**
     * Get top 10 most missed questions per section
     */
    public function getMostMissedQuestions($testVersionId = null, $limit = 10)
    {
        $query = DB::table('candidate_answers')
            ->join('questions', 'questions.id', '=', 'candidate_answers.question_id')
            ->join('test_sections', 'test_sections.id', '=', 'questions.test_section_id')
            ->join('test_attempts', 'test_attempts.id', '=', 'candidate_answers.test_attempt_id')
            ->where('test_attempts.status', 'completed')
            ->where('candidate_answers.is_correct', false);

        if ($testVersionId) {
            $query->where('test_attempts.test_version_id', $testVersionId);
        }

        $missedQuestions = $query
            ->select(
                'questions.id',
                'questions.question_text',
                'test_sections.name as section_name',
                DB::raw('COUNT(*) as miss_count'),
                DB::raw('COUNT(*) * 100.0 / (SELECT COUNT(*) FROM candidate_answers ca2 WHERE ca2.question_id = questions.id) as miss_percentage')
            )
            ->groupBy('questions.id', 'questions.question_text', 'test_sections.name')
            ->orderBy('miss_count', 'desc')
            ->limit($limit)
            ->get();

        return $missedQuestions->groupBy('section_name');
    }

    /**
     * Get overall statistics report
     */
    // public function getOverallReport($testVersionId = null, $startDate = null, $endDate = null)
    // {
    //     $query = TestAttempt::where('status', 'completed');

    //     if ($testVersionId) {
    //         $query->where('test_version_id', $testVersionId);
    //     }

    //     if ($startDate) {
    //         $query->whereDate('completed_at', '>=', $startDate);
    //     }

    //     if ($endDate) {
    //         $query->whereDate('completed_at', '<=', $endDate);
    //     }

    //     $attempts = $query->with('testVersion', 'sectionAttempts')->get();

    //     $totalCandidates = $attempts->pluck('candidate_id')->unique()->count();
    //     $totalAttempts = $attempts->count();
    //     $passedCount = $attempts->where('passed', true)->count();
    //     $failedCount = $attempts->where('passed', false)->count();
    //     $averageScore = $attempts->avg('percentage');

    //     // Section-wise averages
    //     $sectionAverages = [];
    //     foreach ($attempts->first()->sectionAttempts ?? [] as $sa) {
    //         $sectionId = $sa->test_section_id;
    //         $sectionName = $sa->testSection->name;

    //         $sectionCorrect = 0;
    //         $sectionTotal = 0;

    //         foreach ($attempts as $attempt) {
    //             $sectionData = $attempt->sectionAttempts()
    //                 ->where('test_section_id', $sectionId)
    //                 ->first();

    //             if ($sectionData) {
    //                 $sectionCorrect += $sectionData->correct_answers;
    //                 $sectionTotal += $sectionData->total_questions;
    //             }
    //         }

    //         $sectionAverages[$sectionName] = $sectionTotal > 0 
    //             ? round(($sectionCorrect / $sectionTotal) * 100, 2)
    //             : 0;
    //     }

    //     return [
    //         'total_candidates' => $totalCandidates,
    //         'total_attempts' => $totalAttempts,
    //         'passed_count' => $passedCount,
    //         'failed_count' => $failedCount,
    //         'pass_rate' => $totalAttempts > 0 ? round(($passedCount / $totalAttempts) * 100, 2) : 0,
    //         'average_score' => round($averageScore, 2),
    //         'section_averages' => $sectionAverages,
    //         'highest_score' => $attempts->max('percentage'),
    //         'lowest_score' => $attempts->min('percentage'),
    //     ];
    // }

    public function getCategoryReport($testVersionId = null)
    {
        $query = TestAttempt::with(['testVersion', 'sectionAttempts.testSection'])
            ->where('status', 'completed');

        if ($testVersionId) {
            $query->where('test_version_id', $testVersionId);
        }

        $attempts = $query->get();

        $sections = [];
        $missedQuestions = [];

        foreach ($attempts as $attempt) {
            foreach ($attempt->sectionAttempts as $sectionAttempt) {
                $sectionName = $sectionAttempt->testSection->name;

                if (!isset($sections[$sectionName])) {
                    $sections[$sectionName] = [
                        'name' => $sectionName,
                        'total_attempts' => 0,
                        'total_correct' => 0,
                        'total_questions' => 0,
                        'average_percentage' => 0,
                    ];
                }

                $sections[$sectionName]['total_attempts']++;
                $sections[$sectionName]['total_correct'] += $sectionAttempt->correct_answers;
                $sections[$sectionName]['total_questions'] += $sectionAttempt->total_questions;
            }
        }

        foreach ($sections as $key => $section) {
            $sections[$key]['average_percentage'] = $section['total_questions'] > 0
                ? round(($section['total_correct'] / $section['total_questions']) * 100, 1)
                : 0;
        }

        // Get most missed questions per section
        $testSections = TestSection::all();
        foreach ($testSections as $section) {
            $missedQuestions[$section->name] = $this->getMostMissedQuestions($section->id, 10);
        }

        return [
            'sections' => $sections,
            'missed_questions' => $missedQuestions,
        ];
    }

    public function getOverallReport($testVersionId = null, $startDate = null, $endDate = null)
    {
        $query = TestAttempt::where('status', 'completed');

        if ($testVersionId) {
            $query->where('test_version_id', $testVersionId);
        }

        if ($startDate) {
            $query->whereDate('completed_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('completed_at', '<=', $endDate);
        }

        $attempts = $query->get();

        $totalCandidates = $attempts->pluck('candidate_id')->unique()->count();
        $totalAttempts = $attempts->count();
        $passedCount = $attempts->where('passed', true)->count();
        $failedCount = $attempts->where('passed', false)->count();
        $passRate = $totalAttempts > 0 ? round(($passedCount / $totalAttempts) * 100, 1) : 0;

        $scores = $attempts->pluck('percentage');
        $highestScore = $scores->max() ?? 0;
        $lowestScore = $scores->min() ?? 0;
        $averageScore = $scores->avg() ? round($scores->avg(), 1) : 0;

        // Section averages
        $sectionAverages = [];
        $sectionAttempts = SectionAttempt::whereIn('test_attempt_id', $attempts->pluck('id'))->get();

        foreach ($sectionAttempts->groupBy('test_section_id') as $sectionId => $sectionData) {
            $section = TestSection::find($sectionId);
            if ($section) {
                $totalCorrect = $sectionData->sum('correct_answers');
                $totalQuestions = $sectionData->sum('total_questions');
                $sectionAverages[$section->name] = $totalQuestions > 0
                    ? round(($totalCorrect / $totalQuestions) * 100, 1)
                    : 0;
            }
        }

        return [
            'total_candidates' => $totalCandidates,
            'total_attempts' => $totalAttempts,
            'passed_count' => $passedCount,
            'failed_count' => $failedCount,
            'pass_rate' => $passRate,
            'highest_score' => $highestScore,
            'lowest_score' => $lowestScore,
            'average_score' => $averageScore,
            'section_averages' => $sectionAverages,
        ];
    }
}
