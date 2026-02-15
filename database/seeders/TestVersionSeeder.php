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
        DB::table('version_sections')->delete();
        TestVersion::query()->delete();

        $allSections = TestSection::orderBy('display_order')->get();
        $sectionsByName = $allSections->keyBy('name');

        $versions = [
            [
                'title' => 'GBTS CBT - Lower Division Clerk (BS-7)',
                'description' => 'Computer Based Test for Lower Division Clerk (BS-7) conducted by Gilgit-Baltistan Testing Service.',
                'version_code' => 'GBTS-LDC-BS07',
                'section_time_limit' => 8,
                'questions_per_section' => 8,
                'expected_candidates' => 200,
                'overlap_threshold' => 30,
                'pass_threshold' => 40,
                'status' => 'active',
                'sections' => [
                    'English',
                    'General Knowledge',
                    'Pakistan Studies',
                    'Islamic Studies',
                ],
            ],
            [
                'title' => 'GBTS CBT - Junior Clerk (BS-11)',
                'description' => 'Computer Based Test for Junior Clerk (BS-11) conducted by Gilgit-Baltistan Testing Service.',
                'version_code' => 'GBTS-JCLK-BS11',
                'section_time_limit' => 10,
                'questions_per_section' => 10,
                'expected_candidates' => 150,
                'overlap_threshold' => 25,
                'pass_threshold' => 45,
                'status' => 'active',
                'sections' => [
                    'English',
                    'General Knowledge',
                    'Pakistan Studies',
                    'Islamic Studies',
                    'Analytical Reasoning',
                ],
            ],
            [
                'title' => 'GBTS CBT - Computer Operator (BS-14)',
                'description' => 'Computer Based Test for Computer Operator / Data Entry Operator (BS-14) conducted by Gilgit-Baltistan Testing Service.',
                'version_code' => 'GBTS-COMP-BS14',
                'section_time_limit' => 12,
                'questions_per_section' => 10,
                'expected_candidates' => 100,
                'overlap_threshold' => 20,
                'pass_threshold' => 50,
                'status' => 'active',
                'sections' => [
                    'English',
                    'General Knowledge',
                    'Mathematics',
                    'Computer Skills',
                    'Analytical Reasoning',
                ],
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

            foreach ($versionData['sections'] as $order => $sectionName) {
                if (isset($sectionsByName[$sectionName])) {
                    DB::table('version_sections')->insert([
                        'test_version_id' => $version->id,
                        'test_section_id' => $sectionsByName[$sectionName]->id,
                        'section_order' => $order,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}