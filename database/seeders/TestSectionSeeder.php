<?php

namespace Database\Seeders;

use App\Models\TestSection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TestSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            ['name' => 'Verbal Reasoning', 'display_order' => 1],
            ['name' => 'Non-Verbal Reasoning', 'display_order' => 2],
            ['name' => 'Numerical Ability', 'display_order' => 3],
            ['name' => 'General Knowledge', 'display_order' => 4],
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