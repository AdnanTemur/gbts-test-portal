<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        // Create 20 sample candidates
        $candidates = [
            ['cnic' => '12345-1234567-1', 'name' => 'Ahmed Ali', 'father_name' => 'Ali Khan', 'phone' => '0300-1234567', 'email' => 'ahmed@example.com'],
            ['cnic' => '12345-1234567-2', 'name' => 'Muhammad Hassan', 'father_name' => 'Hassan Shah', 'phone' => '0301-1234567', 'email' => 'hassan@example.com'],
            ['cnic' => '12345-1234567-3', 'name' => 'Usman Malik', 'father_name' => 'Malik Ahmed', 'phone' => '0302-1234567', 'email' => null],
            ['cnic' => '12345-1234567-4', 'name' => 'Bilal Raza', 'father_name' => 'Raza Hussain', 'phone' => '0303-1234567', 'email' => 'bilal@example.com'],
            ['cnic' => '12345-1234567-5', 'name' => 'Hamza Shahid', 'father_name' => 'Shahid Iqbal', 'phone' => '0304-1234567', 'email' => null],
            ['cnic' => '12345-1234567-6', 'name' => 'Saad Khan', 'father_name' => 'Khan Sahib', 'phone' => '0305-1234567', 'email' => 'saad@example.com'],
            ['cnic' => '12345-1234567-7', 'name' => 'Zain Abbas', 'father_name' => 'Abbas Ali', 'phone' => '0306-1234567', 'email' => 'zain@example.com'],
            ['cnic' => '12345-1234567-8', 'name' => 'Faisal Mehmood', 'father_name' => 'Mehmood Khan', 'phone' => '0307-1234567', 'email' => null],
            ['cnic' => '12345-1234567-9', 'name' => 'Arslan Ahmed', 'father_name' => 'Ahmed Raza', 'phone' => '0308-1234567', 'email' => 'arslan@example.com'],
            ['cnic' => '12345-1234568-0', 'name' => 'Talha Siddiqui', 'father_name' => 'Siddiqui Sahib', 'phone' => '0309-1234567', 'email' => 'talha@example.com'],
        ];

        foreach ($candidates as $candidate) {
            Candidate::create($candidate);
        }

        // Create 10 more random candidates
        Candidate::factory(10)->create();
    }
}