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
        // Clean existing data
        DB::table('version_sections')->delete();
        TestVersion::query()->delete();

        $allSections = TestSection::orderBy('display_order')->get();
        $sectionsByName = $allSections->keyBy('name');

        $versions = [
            // ─────────────────────────────────────────────────────────────
            // BS-16 Assistant (Upper Division Clerk level)
            // FPSC pattern: English, GK, Pakistan Studies, Islamic Studies,
            //               Mathematics, Computer Skills
            // ─────────────────────────────────────────────────────────────
            [
                'title' => 'FPSC Assistant BS-16 Mock Test',
                'description' => 'Mock test for FPSC Assistant (BS-16) post. Covers English, General Knowledge, Pakistan Studies, Islamic Studies, Mathematics and Computer Skills as per FPSC syllabus.',
                'version_code' => 'FPSC-ASST-BS16',
                'section_time_limit' => 12,
                'questions_per_section' => 10,
                'expected_candidates' => 100,
                'overlap_threshold' => 20,
                'pass_threshold' => 50,
                'status' => 'active',
                'sections' => [
                    'English',
                    'General Knowledge',
                    'Pakistan Studies',
                    'Islamic Studies',
                    'Mathematics',
                    'Computer Skills',
                ],
            ],

            // ─────────────────────────────────────────────────────────────
            // BS-17 Clerk / Junior Clerk
            // FPSC pattern: English, GK, Pakistan Studies, Islamic Studies,
            //               Analytical Reasoning
            // ─────────────────────────────────────────────────────────────
            [
                'title' => 'FPSC Junior Clerk BS-11 Mock Test',
                'description' => 'Mock test for FPSC Junior Clerk (BS-11) post. Covers English, General Knowledge, Pakistan Studies, Islamic Studies and Analytical Reasoning as per FPSC syllabus.',
                'version_code' => 'FPSC-JCLK-BS11',
                'section_time_limit' => 10,
                'questions_per_section' => 8,
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

            // ─────────────────────────────────────────────────────────────
            // BS-17 Data Entry Operator / Computer Operator
            // FPSC pattern: English, GK, Mathematics, Computer Skills,
            //               Analytical Reasoning
            // ─────────────────────────────────────────────────────────────
            [
                'title' => 'FPSC Computer Operator BS-14 Mock Test',
                'description' => 'Mock test for FPSC Computer Operator / Data Entry Operator (BS-14) post. Focuses heavily on Computer Skills, Mathematics and Analytical Reasoning alongside English and General Knowledge.',
                'version_code' => 'FPSC-COMP-BS14',
                'section_time_limit' => 15,
                'questions_per_section' => 12,
                'expected_candidates' => 80,
                'overlap_threshold' => 20,
                'pass_threshold' => 55,
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

            // Attach only the relevant sections for this post
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