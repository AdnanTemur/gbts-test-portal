<?php

namespace Database\Seeders;

use App\Models\TestSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TestSectionSeeder extends Seeder
{
    public function run(): void
    {
        TestSection::query()->delete();

        $sections = [
            ['name' => 'English', 'display_order' => 1],
            ['name' => 'General Knowledge', 'display_order' => 2],
            ['name' => 'Pakistan Studies', 'display_order' => 3],
            ['name' => 'Islamic Studies', 'display_order' => 4],
            ['name' => 'Mathematics', 'display_order' => 5],
            ['name' => 'Computer Skills', 'display_order' => 6],
            ['name' => 'Analytical Reasoning', 'display_order' => 7],
        ];

        foreach ($sections as $section) {
            TestSection::create([
                'name' => $section['name'],
                'slug' => Str::slug($section['name']),
                'display_order' => $section['display_order'],
                'is_active' => true,
            ]);
        }
    }
}