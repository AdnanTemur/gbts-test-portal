<?php

namespace App\Services;

use App\Models\TestAttempt;
use App\Models\SectionAttempt;
use App\Models\QuestionAssignment;
use App\Models\TestVersion;
use App\Models\TestSection;

class DistributionService
{
    /**
     * Generate question assignments for a test attempt across all sections
     */
    public function generateAssignments(TestAttempt $testAttempt): bool
    {
        $testVersion = $testAttempt->testVersion;
        $sections = $testVersion->testSections;
        
        // Track all assigned questions to avoid duplicates across sections
        $allAssignedQuestions = [];
        
        foreach ($sections as $index => $section) {
            // Create section attempt
            $sectionAttempt = SectionAttempt::create([
                'test_attempt_id' => $testAttempt->id,
                'test_section_id' => $section->id,
                'section_order' => $index,
                'status' => 'not_started',
            ]);
            
            // Get available questions for this section (excluding already assigned)
            $availableQuestions = $section->activeQuestions()
                ->whereNotIn('id', $allAssignedQuestions)
                ->pluck('id')
                ->toArray();
            
            if (empty($availableQuestions)) {
                // If no unique questions available, allow reuse but track usage
                $availableQuestions = $section->activeQuestions()->pluck('id')->toArray();
            }
            
            // Shuffle if configured
            if ($testVersion->shuffle_questions) {
                shuffle($availableQuestions);
            }
            
            // Select questions for this section
            $selectedQuestions = array_slice($availableQuestions, 0, $testVersion->questions_per_section);
            
            // Track assigned questions
            $allAssignedQuestions = array_merge($allAssignedQuestions, $selectedQuestions);
            
            // Create assignments
            foreach ($selectedQuestions as $order => $questionId) {
                QuestionAssignment::create([
                    'test_attempt_id' => $testAttempt->id,
                    'section_attempt_id' => $sectionAttempt->id,
                    'question_id' => $questionId,
                    'display_order' => $order + 1,
                ]);
            }
        }
        
        return true;
    }

    /**
     * Generate optimized assignments to minimize overlap
     */
    public function generateOptimizedAssignments(TestVersion $testVersion, int $numCandidates): array
    {
        $sections = $testVersion->testSections;
        $questionsPerSection = $testVersion->questions_per_section;
        
        $allAssignments = [];
        
        for ($candidateIndex = 0; $candidateIndex < $numCandidates; $candidateIndex++) {
            $candidateAssignments = [];
            $usedQuestions = []; // Track questions used across all sections for this candidate
            
            foreach ($sections as $section) {
                $questionsPool = $section->activeQuestions()->pluck('id')->toArray();
                
                // Remove already used questions in other sections for this candidate
                $availableQuestions = array_diff($questionsPool, $usedQuestions);
                
                if (count($availableQuestions) < $questionsPerSection) {
                    // If not enough unique questions, allow some reuse
                    $availableQuestions = $questionsPool;
                }
                
                // Track question usage across all candidates
                $usageKey = "section_{$section->id}";
                if (!isset($this->questionUsage[$usageKey])) {
                    $this->questionUsage[$usageKey] = array_fill_keys($questionsPool, 0);
                }
                
                // Sort by least used
                uasort($this->questionUsage[$usageKey], function($a, $b) {
                    return $a <=> $b;
                });
                
                $sortedQuestions = array_keys($this->questionUsage[$usageKey]);
                
                // Filter to available questions only
                $sortedAvailable = array_intersect($sortedQuestions, $availableQuestions);
                
                // Select questions
                $selectedQuestions = array_slice($sortedAvailable, 0, $questionsPerSection);
                
                // Update usage counts
                foreach ($selectedQuestions as $qid) {
                    $this->questionUsage[$usageKey][$qid]++;
                }
                
                $candidateAssignments[$section->name] = $selectedQuestions;
                $usedQuestions = array_merge($usedQuestions, $selectedQuestions);
            }
            
            $allAssignments[] = $candidateAssignments;
        }
        
        return $allAssignments;
    }

    /**
     * Calculate overlap statistics
     */
    public function calculateOverlapStatistics(array $assignments): array
    {
        if (count($assignments) < 2) {
            return [
                'average_overlap' => 0,
                'max_overlap' => 0,
                'min_overlap' => 0,
                'section_overlap' => [],
            ];
        }

        $sections = array_keys($assignments[0]);
        $sectionOverlap = [];
        
        foreach ($sections as $section) {
            $overlapCounts = [];
            
            for ($i = 0; $i < count($assignments); $i++) {
                for ($j = $i + 1; $j < count($assignments); $j++) {
                    $commonQuestions = count(array_intersect(
                        $assignments[$i][$section],
                        $assignments[$j][$section]
                    ));
                    
                    $totalQuestions = count($assignments[$i][$section]);
                    $overlapPercentage = ($commonQuestions / $totalQuestions) * 100;
                    $overlapCounts[] = $overlapPercentage;
                }
            }
            
            $sectionOverlap[$section] = [
                'average' => round(array_sum($overlapCounts) / count($overlapCounts), 2),
                'max' => round(max($overlapCounts), 2),
                'min' => round(min($overlapCounts), 2),
            ];
        }
        
        // Calculate overall statistics
        $allOverlaps = [];
        foreach ($sectionOverlap as $stats) {
            $allOverlaps[] = $stats['average'];
        }
        
        return [
            'average_overlap' => round(array_sum($allOverlaps) / count($allOverlaps), 2),
            'max_overlap' => round(max(array_column($sectionOverlap, 'max')), 2),
            'min_overlap' => round(min(array_column($sectionOverlap, 'min')), 2),
            'section_overlap' => $sectionOverlap,
        ];
    }

    private $questionUsage = [];
}
