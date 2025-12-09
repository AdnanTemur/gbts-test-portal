<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\TestSection;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'test_section_id' => TestSection::factory(),
            'question_type' => $this->faker->randomElement(['mcq', 'true_false', 'matching']),
            'question_text' => $this->faker->sentence() . '?',
            'question_image' => null,
            'difficulty_level' => $this->faker->randomElement(['easy', 'medium', 'hard']),
            'marks' => $this->faker->numberBetween(1, 3),
            'is_active' => true,
        ];
    }

    public function mcq(): static
    {
        return $this->state(fn (array $attributes) => [
            'question_type' => 'mcq',
        ]);
    }

    public function trueFalse(): static
    {
        return $this->state(fn (array $attributes) => [
            'question_type' => 'true_false',
        ]);
    }

    public function matching(): static
    {
        return $this->state(fn (array $attributes) => [
            'question_type' => 'matching',
        ]);
    }

    public function easy(): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty_level' => 'easy',
        ]);
    }

    public function medium(): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty_level' => 'medium',
        ]);
    }

    public function hard(): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty_level' => 'hard',
        ]);
    }
}