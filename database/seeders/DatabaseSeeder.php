<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([

            UserSeeder::class,
            TestSectionSeeder::class,
            QuestionSeeder::class,
            TestVersionSeeder::class,
            CandidateSeeder::class,
            CompleteTestDataSeeder::class,
        ]);
    }
}