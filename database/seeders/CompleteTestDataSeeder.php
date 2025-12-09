<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\TestVersion;
use App\Models\TestAttempt;
use App\Services\DistributionService;
use App\Services\ScoringService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompleteTestDataSeeder extends Seeder
{
    protected $distributionService;
    protected $scoringService;

    public function __construct()
    {
        $this->distributionService = new DistributionService();
        $this->scoringService = new ScoringService();
    }

    public function run(): void
    {
        $this->command->info('Creating completed test attempts...');

        $candidates = Candidate::take(10)->get();
        $testVersions = TestVersion::where('status', 'active')->get();

        if ($testVersions->isEmpty()) {
            $this->command->warn('No active test versions found. Skipping completed test data.');
            return;
        }

        if ($candidates->isEmpty()) {
            $this->command->warn('No candidates found. Skipping completed test data.');
            return;
        }

        foreach ($candidates as $index => $candidate) {
            // Each candidate takes 1-2 tests
            $testsToTake = rand(1, 2);

            for ($i = 0; $i < $testsToTake; $i++) {
                $testVersion = $testVersions->random();

                $this->command->info("Creating test attempt " . ($i + 1) . " for {$candidate->name}...");

                try {
                    // Create test attempt with unique token
                    $attempt = TestAttempt::create([
                        'candidate_id' => $candidate->id,
                        'test_version_id' => $testVersion->id,
                        'attempt_token' => Str::random(32),
                        'status' => 'in_progress',
                        'current_section_index' => 0,
                        'started_at' => now()->subHours(rand(1, 48)),
                    ]);

                    // Generate question assignments
                    $this->distributionService->generateAssignments($attempt);

                    // Reload the attempt to get fresh relationships
                    $attempt->refresh();
                    $attempt->load('testVersion.testSections');

                    // Create section attempts ONLY ONCE per section
                    foreach ($attempt->testVersion->testSections as $sectionIndex => $section) {
                        // Check if section attempt already exists
                        $existingSection = $attempt->sectionAttempts()
                            ->where('test_section_id', $section->id)
                            ->first();

                        if (!$existingSection) {
                            $attempt->sectionAttempts()->create([
                                'test_section_id' => $section->id,
                                'section_order' => $sectionIndex,
                                'status' => 'completed',
                                'started_at' => now()->subMinutes(rand(15, 45)),
                                'completed_at' => now()->subMinutes(rand(1, 14)),
                                'total_questions' => 0, // Will update later
                                'correct_answers' => 0, // Will update later
                                'incorrect_answers' => 0, // Will update later
                            ]);
                        }
                    }

                    // Simulate completing the test
                    $this->simulateTestCompletion($attempt);

                    $this->command->info("✓ Test attempt completed for {$candidate->name}");

                } catch (\Exception $e) {
                    $this->command->error("✗ Failed to create test for {$candidate->name}: " . $e->getMessage());
                    continue;
                }
            }
        }

        $this->command->info('Completed test data seeded successfully!');
    }

    private function simulateTestCompletion($attempt)
    {
        // Reload to ensure we have all relationships
        $attempt->refresh();
        $attempt->load(['questionAssignments.question.options', 'questionAssignments.question.matchingPairs', 'sectionAttempts']);

        // Simulate answering questions (60-90% correct rate)
        $assignments = $attempt->questionAssignments;
        $correctRate = rand(60, 90) / 100;

        foreach ($assignments as $assignment) {
            $question = $assignment->question;

            // Randomly decide if answer is correct
            $shouldBeCorrect = (rand(1, 100) / 100) <= $correctRate;

            if ($question->isMCQ() || $question->isTrueFalse()) {
                $options = $question->options;

                if ($options->isEmpty()) {
                    continue; // Skip if no options
                }

                if ($shouldBeCorrect) {
                    $selectedOption = $options->where('is_correct', true)->first();
                } else {
                    $wrongOptions = $options->where('is_correct', false);
                    $selectedOption = $wrongOptions->isNotEmpty() ? $wrongOptions->random() : null;
                }

                if ($selectedOption) {
                    $this->scoringService->saveAnswerForAttempt(
                        $attempt,
                        $question,
                        ['selected_option_id' => $selectedOption->id]
                    );
                }
            } elseif ($question->isMatching()) {
                $pairs = $question->matchingPairs;

                if ($pairs->isEmpty()) {
                    continue; // Skip if no pairs
                }

                $matchingAnswers = [];

                foreach ($pairs as $pair) {
                    if ($shouldBeCorrect) {
                        $matchingAnswers[$pair->pair_order] = $pair->column_b_key;
                    } else {
                        // Wrong answer - pick random key
                        $wrongKey = chr(65 + rand(0, 3)); // A, B, C, or D
                        $matchingAnswers[$pair->pair_order] = $wrongKey;
                    }
                }

                if (count($matchingAnswers) === 4) {
                    $this->scoringService->saveAnswerForAttempt(
                        $attempt,
                        $question,
                        ['matching_answers' => $matchingAnswers]
                    );
                }
            }
        }

        // Calculate final scores
        $attempt->refresh();
        $totalQuestions = $attempt->candidateAnswers()->count();
        $correctAnswers = $attempt->candidateAnswers()->where('is_correct', true)->count();
        $incorrectAnswers = $attempt->candidateAnswers()->where('is_correct', false)->count();
        $unanswered = $assignments->count() - $totalQuestions;
        $percentage = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;
        $passed = $percentage >= $attempt->testVersion->pass_threshold;

        // Update section attempts with correct scores
        foreach ($attempt->sectionAttempts as $sectionAttempt) {
            $sectionAnswers = $attempt->candidateAnswers()
                ->whereHas('question', function ($q) use ($sectionAttempt) {
                    $q->where('test_section_id', $sectionAttempt->test_section_id);
                })->get();

            $sectionAttempt->update([
                'total_questions' => $sectionAnswers->count(),
                'correct_answers' => $sectionAnswers->where('is_correct', true)->count(),
                'incorrect_answers' => $sectionAnswers->where('is_correct', false)->count(),
            ]);
        }

        // Update test attempt as completed
        $attempt->update([
            'status' => 'completed',
            'completed_at' => now(),
            'time_taken' => rand(1800, 5400), // 30-90 minutes
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'incorrect_answers' => $incorrectAnswers,
            'unanswered' => $unanswered,
            'percentage' => $percentage,
            'passed' => $passed,
        ]);
    }
}