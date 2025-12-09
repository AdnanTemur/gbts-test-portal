<?php

namespace App\Http\Controllers;

use App\Models\TestAttempt;
use App\Models\SectionAttempt;
use App\Models\Question;
use App\Services\ScoringService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $scoringService;

    public function __construct(ScoringService $scoringService)
    {
        $this->scoringService = $scoringService;
    }

    /**
     * Show test start page
     */
    public function start($token)
    {
        $testAttempt = TestAttempt::where('attempt_token', $token)->firstOrFail();

        if ($testAttempt->status === 'completed') {
            return redirect()->route('results.show', $token);
        }

        return view('test.start', compact('testAttempt'));
    }

    /**
     * Show instructions page
     */
    public function instructions($token)
    {
        $testAttempt = TestAttempt::where('attempt_token', $token)->firstOrFail();

        if ($testAttempt->status === 'completed') {
            return redirect()->route('results.show', $token);
        }

        return view('test.instructions', compact('testAttempt'));
    }

    /**
     * Begin the test (start first section)
     */
    public function begin($token)
    {
        $testAttempt = TestAttempt::where('attempt_token', $token)->firstOrFail();

        if ($testAttempt->status === 'not_started') {
            $testAttempt->update([
                'status' => 'in_progress',
                'started_at' => now(),
            ]);

            // Start first section
            $firstSection = $testAttempt->sectionAttempts()->where('section_order', 0)->first();
            if ($firstSection) {
                $firstSection->update([
                    'status' => 'in_progress',
                    'started_at' => now(),
                ]);
            }
        }

        return redirect()->route('test.section', $token);
    }

    /**
     * Show current section
     */
    public function section($token)
    {
        $testAttempt = TestAttempt::where('attempt_token', $token)->firstOrFail();

        if ($testAttempt->status === 'completed') {
            return redirect()->route('results.show', $token);
        }

        $currentSection = $testAttempt->getCurrentSection();

        if (!$currentSection) {
            // All sections completed
            return $this->completeTest($testAttempt);
        }

        // Check if section time has expired
        if ($currentSection->hasExpired()) {
            return $this->autoSubmitSection($testAttempt, $currentSection);
        }

        // Load questions with options/pairs
        $questions = $currentSection->questionAssignments()
            ->with(['question.options', 'question.matchingPairs'])
            ->orderBy('display_order')
            ->get()
            ->map(function ($assignment) use ($testAttempt) {
                $question = $assignment->question;
                
                // Shuffle options if configured
                if ($testAttempt->testVersion->shuffle_options) {
                    if ($question->isMCQ() || $question->isTrueFalse()) {
                        $options = $question->options->shuffle();
                        $question->setRelation('options', $options);
                    } elseif ($question->isMatching()) {
                        // Shuffle column B in matching pairs
                        $pairs = $question->matchingPairs;
                        $columnBItems = $pairs->pluck('column_b_text', 'column_b_key')->shuffle();
                        $question->shuffled_column_b = $columnBItems;
                    }
                }
                
                return $assignment;
            });

        // Get existing answers for this section
        $existingAnswers = $testAttempt->candidateAnswers()
            ->where('section_attempt_id', $currentSection->id)
            ->get()
            ->keyBy('question_id');

        // Calculate end time
        $endTime = $currentSection->started_at
            ->addMinutes($testAttempt->testVersion->section_time_limit);

        return view('test.section', compact(
            'testAttempt',
            'currentSection',
            'questions',
            'existingAnswers',
            'endTime'
        ));
    }

    /**
     * Save answer (AJAX)
     */
    public function saveAnswer(Request $request, $token)
    {
        $testAttempt = TestAttempt::where('attempt_token', $token)->firstOrFail();
        $currentSection = $testAttempt->getCurrentSection();

        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'selected_option_id' => 'nullable|exists:question_options,id',
            'matching_answers' => 'nullable|array',
        ]);

        $this->scoringService->saveAnswer([
            'test_attempt_id' => $testAttempt->id,
            'section_attempt_id' => $currentSection->id,
            'question_id' => $validated['question_id'],
            'selected_option_id' => $validated['selected_option_id'] ?? null,
            'matching_answers' => $validated['matching_answers'] ?? null,
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Move to next section
     */
    public function nextSection($token)
    {
        $testAttempt = TestAttempt::where('attempt_token', $token)->firstOrFail();
        $currentSection = $testAttempt->getCurrentSection();

        // Complete current section
        $currentSection->update([
            'status' => 'completed',
            'completed_at' => now(),
            'time_taken' => now()->diffInSeconds($currentSection->started_at),
        ]);

        // Calculate section score
        $currentSection->calculateScore();

        // Move to next section
        if ($testAttempt->moveToNextSection()) {
            $nextSection = $testAttempt->getCurrentSection();
            $nextSection->update([
                'status' => 'in_progress',
                'started_at' => now(),
            ]);

            return redirect()->route('test.section', $token);
        }

        // No more sections - complete test
        return $this->completeTest($testAttempt);
    }

    /**
     * Submit entire test
     */
    public function submit($token)
    {
        $testAttempt = TestAttempt::where('attempt_token', $token)->firstOrFail();
        
        return $this->completeTest($testAttempt);
    }

    /**
     * Complete the test
     */
    private function completeTest(TestAttempt $testAttempt)
    {
        // Complete any remaining sections
        $currentSection = $testAttempt->getCurrentSection();
        if ($currentSection && $currentSection->status !== 'completed') {
            $currentSection->update([
                'status' => 'completed',
                'completed_at' => now(),
                'time_taken' => now()->diffInSeconds($currentSection->started_at),
            ]);
            $currentSection->calculateScore();
        }

        // Calculate total score
        $testAttempt->update([
            'status' => 'completed',
            'completed_at' => now(),
            'time_taken' => now()->diffInSeconds($testAttempt->started_at),
        ]);

        $testAttempt->calculateScore();

        return redirect()->route('results.show', $testAttempt->attempt_token);
    }

    /**
     * Auto-submit section when time expires
     */
    private function autoSubmitSection(TestAttempt $testAttempt, SectionAttempt $currentSection)
    {
        $currentSection->update([
            'status' => 'timeout',
            'completed_at' => now(),
            'time_taken' => now()->diffInSeconds($currentSection->started_at),
        ]);

        $currentSection->calculateScore();

        // Move to next section
        if ($testAttempt->moveToNextSection()) {
            $nextSection = $testAttempt->getCurrentSection();
            $nextSection->update([
                'status' => 'in_progress',
                'started_at' => now(),
            ]);

            return redirect()->route('test.section', $testAttempt->attempt_token)
                ->with('info', 'Previous section time expired. Moving to next section.');
        }

        // No more sections - complete test
        return $this->completeTest($testAttempt);
    }
}
