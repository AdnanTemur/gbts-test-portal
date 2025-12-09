<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\MatchingPair;
use App\Models\TestSection;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = TestSection::all();

        foreach ($sections as $section) {
            // Create 50 questions per section (mix of all types)
            
            // 30 MCQ questions
            for ($i = 0; $i < 30; $i++) {
                $question = Question::create([
                    'test_section_id' => $section->id,
                    'question_type' => 'mcq',
                    'question_text' => $this->getQuestionText($section->name, 'mcq', $i + 1),
                    'difficulty_level' => ['easy', 'medium', 'hard'][array_rand(['easy', 'medium', 'hard'])],
                    'marks' => rand(1, 2),
                    'is_active' => true,
                ]);

                // Create 4 options
                $correctOption = rand(0, 3);
                for ($j = 0; $j < 4; $j++) {
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'option_text' => $this->getOptionText($j),
                        'is_correct' => $j === $correctOption,
                        'display_order' => $j,
                    ]);
                }
            }

            // 10 True/False questions
            for ($i = 0; $i < 10; $i++) {
                $question = Question::create([
                    'test_section_id' => $section->id,
                    'question_type' => 'true_false',
                    'question_text' => $this->getQuestionText($section->name, 'true_false', $i + 1),
                    'difficulty_level' => ['easy', 'medium'][array_rand(['easy', 'medium'])],
                    'marks' => 1,
                    'is_active' => true,
                ]);

                // Create True/False options
                $correctAnswer = rand(0, 1);
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => 'True',
                    'is_correct' => $correctAnswer === 0,
                    'display_order' => 0,
                ]);
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => 'False',
                    'is_correct' => $correctAnswer === 1,
                    'display_order' => 1,
                ]);
            }

            // 10 Matching questions
            for ($i = 0; $i < 10; $i++) {
                $question = Question::create([
                    'test_section_id' => $section->id,
                    'question_type' => 'matching',
                    'question_text' => $this->getQuestionText($section->name, 'matching', $i + 1),
                    'difficulty_level' => ['medium', 'hard'][array_rand(['medium', 'hard'])],
                    'marks' => 2,
                    'is_active' => true,
                ]);

                // Create 4 matching pairs
                $pairs = $this->getMatchingPairs($section->name);
                foreach ($pairs as $index => $pair) {
                    MatchingPair::create([
                        'question_id' => $question->id,
                        'column_a_text' => $pair['a'],
                        'column_b_text' => $pair['b'],
                        'column_b_key' => chr(65 + $index), // A, B, C, D
                        'pair_order' => $index + 1,
                    ]);
                }
            }
        }
    }

    private function getQuestionText($sectionName, $type, $number): string
    {
        $questions = [
            'Verbal Reasoning' => [
                'mcq' => "Choose the word most similar in meaning to 'Eloquent' ($number):",
                'true_false' => "The word 'Benign' means harmful ($number).",
                'matching' => "Match the synonyms ($number):",
            ],
            'Non-Verbal Reasoning' => [
                'mcq' => "Which figure completes the pattern ($number)?",
                'true_false' => "The next shape in the sequence is a circle ($number).",
                'matching' => "Match the shapes to their rotations ($number):",
            ],
            'Numerical Ability' => [
                'mcq' => "What is 15% of 200 ($number)?",
                'true_false' => "The square root of 144 is 13 ($number).",
                'matching' => "Match the fractions to their decimal equivalents ($number):",
            ],
            'General Knowledge' => [
                'mcq' => "Who was the founder of Pakistan ($number)?",
                'true_false' => "Pakistan became independent in 1948 ($number).",
                'matching' => "Match the cities to their provinces ($number):",
            ],
        ];

        return $questions[$sectionName][$type] ?? "Sample question $number for $sectionName ($type)";
    }

    private function getOptionText($index): string
    {
        $options = [
            ['Fluent', 'Silent', 'Awkward', 'Hesitant'],
            ['Red', 'Blue', 'Green', 'Yellow'],
            ['25', '30', '35', '40'],
            ['Muhammad Ali Jinnah', 'Allama Iqbal', 'Liaquat Ali Khan', 'Fatima Jinnah'],
        ];

        $randomSet = $options[array_rand($options)];
        return $randomSet[$index] ?? "Option " . chr(65 + $index);
    }

    private function getMatchingPairs($sectionName): array
    {
        $pairs = [
            'Verbal Reasoning' => [
                ['a' => 'Happy', 'b' => 'Joyful'],
                ['a' => 'Sad', 'b' => 'Melancholy'],
                ['a' => 'Fast', 'b' => 'Swift'],
                ['a' => 'Big', 'b' => 'Large'],
            ],
            'Non-Verbal Reasoning' => [
                ['a' => 'Circle', 'b' => 'Round shape'],
                ['a' => 'Square', 'b' => '4 equal sides'],
                ['a' => 'Triangle', 'b' => '3 sides'],
                ['a' => 'Pentagon', 'b' => '5 sides'],
            ],
            'Numerical Ability' => [
                ['a' => '1/2', 'b' => '0.5'],
                ['a' => '1/4', 'b' => '0.25'],
                ['a' => '3/4', 'b' => '0.75'],
                ['a' => '1/5', 'b' => '0.2'],
            ],
            'General Knowledge' => [
                ['a' => 'Lahore', 'b' => 'Punjab'],
                ['a' => 'Karachi', 'b' => 'Sindh'],
                ['a' => 'Peshawar', 'b' => 'KPK'],
                ['a' => 'Quetta', 'b' => 'Balochistan'],
            ],
        ];

        return $pairs[$sectionName] ?? [
            ['a' => 'Item 1', 'b' => 'Match 1'],
            ['a' => 'Item 2', 'b' => 'Match 2'],
            ['a' => 'Item 3', 'b' => 'Match 3'],
            ['a' => 'Item 4', 'b' => 'Match 4'],
        ];
    }
}