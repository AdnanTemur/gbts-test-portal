<?php

namespace Database\Factories;

use App\Models\TestSection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TestSectionFactory extends Factory
{
    protected $model = TestSection::class;

    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Verbal Reasoning',
            'Non-Verbal Reasoning',
            'Numerical Ability',
            'General Knowledge',
            'English Comprehension',
            'Logical Reasoning',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'display_order' => $this->faker->numberBetween(0, 10),
            'is_active' => true,
        ];
    }
}