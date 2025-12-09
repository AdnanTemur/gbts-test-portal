<?php

namespace Database\Factories;

use App\Models\TestVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestVersionFactory extends Factory
{
    protected $model = TestVersion::class;

    public function definition(): array
    {
        return [
            'title' => 'Mock Initial PMA Test - ' . $this->faker->monthName() . ' ' . $this->faker->year(),
            'description' => $this->faker->optional()->sentence(),
            'version_code' => 'PMA-' . strtoupper($this->faker->bothify('??##')),
            'section_time_limit' => $this->faker->randomElement([10, 15, 20, 30]),
            'questions_per_section' => $this->faker->randomElement([10, 15, 20]),
            'expected_candidates' => $this->faker->numberBetween(30, 100),
            'overlap_threshold' => $this->faker->numberBetween(15, 30),
            'pass_threshold' => $this->faker->randomElement([50, 60, 70]),
            'shuffle_questions' => true,
            'shuffle_options' => true,
            'status' => $this->faker->randomElement(['draft', 'active', 'completed']),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
        ]);
    }
}