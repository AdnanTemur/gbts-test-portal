<?php

namespace App\Services;

use App\Models\Question;
use App\Models\CandidateAnswer;
use App\Models\TestAttempt;

class ScoringService
{
    /**
     * Evaluate an answer and return if it's correct
     */
    public function evaluateAnswer(Question $question, $answer): bool
    {
        return match($question->question_type) {
            'mcq' => $this->evaluateMCQ($question, $answer),
            'true_false' => $this->evaluateTrueFalse($question, $answer),
            'matching' => $this->evaluateMatching($question, $answer),
            default => false,
        };
    }

    /**
     * Evaluate MCQ answer
     */
    private function evaluateMCQ(Question $question, $selectedOptionId): bool
    {
        $correctOption = $question->correctOption;
        return $correctOption && $correctOption->id == $selectedOptionId;
    }

    /**
     * Evaluate True/False answer
     */
    private function evaluateTrueFalse(Question $question, $selectedOptionId): bool
    {
        return $this->evaluateMCQ($question, $selectedOptionId);
    }

    /**
     * Evaluate Matching answer
     * All pairs must be correctly matched for full marks
     */
    private function evaluateMatching(Question $question, array $matchingAnswers): bool
    {
        $matchingPairs = $question->matchingPairs;
        
        // Check if all pairs are answered
        if (count($matchingAnswers) !== $matchingPairs->count()) {
            return false;
        }
        
        // Check if all matches are correct
        foreach ($matchingPairs as $pair) {
            $candidateAnswer = $matchingAnswers[$pair->pair_order] ?? null;
            
            if ($candidateAnswer !== $pair->column_b_key) {
                return false;
            }
        }
        
        return true;
    }

    /**
     * Save and evaluate an answer (accepts array data)
     * Used by TestController when saving answers via AJAX
     */
    public function saveAnswer(array $data): CandidateAnswer
    {
        $question = Question::findOrFail($data['question_id']);
        
        $answerData = [
            'test_attempt_id' => $data['test_attempt_id'],
            'section_attempt_id' => $data['section_attempt_id'],
            'question_id' => $data['question_id'],
        ];
        
        if ($question->isMCQ() || $question->isTrueFalse()) {
            $answerData['selected_option_id'] = $data['selected_option_id'];
            $answerData['is_correct'] = $this->evaluateAnswer($question, $data['selected_option_id']);
        } elseif ($question->isMatching()) {
            $answerData['matching_answers'] = $data['matching_answers'];
            $answerData['is_correct'] = $this->evaluateAnswer($question, $data['matching_answers']);
        }
        
        return CandidateAnswer::updateOrCreate(
            [
                'test_attempt_id' => $data['test_attempt_id'],
                'question_id' => $data['question_id'],
            ],
            $answerData
        );
    }

    /**
     * Save and evaluate an answer (accepts TestAttempt, Question, and answer data)
     * Used by seeders and other contexts where you have the models directly
     */
    public function saveAnswerForAttempt(TestAttempt $attempt, Question $question, array $answerData): CandidateAnswer
    {
        // Get the current section attempt
        $currentSectionAttempt = $attempt->sectionAttempts()
            ->where('test_section_id', $question->test_section_id)
            ->first();

        if (!$currentSectionAttempt) {
            throw new \Exception("Section attempt not found for question");
        }

        $data = [
            'test_attempt_id' => $attempt->id,
            'section_attempt_id' => $currentSectionAttempt->id,
            'question_id' => $question->id,
        ];

        if ($question->isMCQ() || $question->isTrueFalse()) {
            $data['selected_option_id'] = $answerData['selected_option_id'];
            $data['is_correct'] = $this->evaluateAnswer($question, $answerData['selected_option_id']);
        } elseif ($question->isMatching()) {
            $data['matching_answers'] = $answerData['matching_answers'];
            $data['is_correct'] = $this->evaluateAnswer($question, $answerData['matching_answers']);
        }

        return CandidateAnswer::updateOrCreate(
            [
                'test_attempt_id' => $attempt->id,
                'question_id' => $question->id,
            ],
            $data
        );
    }
}