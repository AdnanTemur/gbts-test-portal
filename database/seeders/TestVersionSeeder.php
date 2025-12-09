<?php

namespace Database\Seeders;

use App\Models\TestVersion;
use App\Models\TestSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestVersionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = TestSection::orderBy('display_order')->get();

        // Create 3 test versions
        $versions = [
            [
                'title' => 'Mock Initial PMA Long Test - December 2024',
                'description' => 'Comprehensive test covering all sections',
                'version_code' => 'PMA-DEC24-L',
                'section_time_limit' => 15,
                'questions_per_section' => 15,
                'expected_candidates' => 50,
                'overlap_threshold' => 20,
                'pass_threshold' => 60,
                'status' => 'active',
            ],
            [
                'title' => 'Mock Initial PMA Short Test - December 2024',
                'description' => 'Quick assessment test',
                'version_code' => 'PMA-DEC24-S',
                'section_time_limit' => 10,
                'questions_per_section' => 10,
                'expected_candidates' => 30,
                'overlap_threshold' => 25,
                'pass_threshold' => 50,
                'status' => 'active',
            ],
            [
                'title' => 'Practice Test - November 2024',
                'description' => 'Practice test for preparation',
                'version_code' => 'PMA-NOV24-P',
                'section_time_limit' => 20,
                'questions_per_section' => 20,
                'expected_candidates' => 100,
                'overlap_threshold' => 15,
                'pass_threshold' => 70,
                'status' => 'completed',
            ],
        ];

        foreach ($versions as $versionData) {
            $version = TestVersion::create([
                'title' => $versionData['title'],
                'description' => $versionData['description'],
                'version_code' => $versionData['version_code'],
                'section_time_limit' => $versionData['section_time_limit'],
                'questions_per_section' => $versionData['questions_per_section'],
                'expected_candidates' => $versionData['expected_candidates'],
                'overlap_threshold' => $versionData['overlap_threshold'],
                'pass_threshold' => $versionData['pass_threshold'],
                'shuffle_questions' => true,
                'shuffle_options' => true,
                'status' => $versionData['status'],
            ]);

            // Attach all sections in order
            foreach ($sections as $index => $section) {
                DB::table('version_sections')->insert([
                    'test_version_id' => $version->id,
                    'test_section_id' => $section->id,
                    'section_order' => $index,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}