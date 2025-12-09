<?php

namespace Database\Factories;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    protected $model = Candidate::class;

    public function definition(): array
    {
        return [
            'cnic' => $this->faker->numerify('#####-#######-#'),
            'name' => $this->faker->name(),
            'father_name' => $this->faker->name('male'),
            'phone' => $this->faker->numerify('03##-#######'),
            'email' => $this->faker->optional(0.7)->email(),
            'photo' => null, // We'll skip actual file creation
        ];
    }
}