<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestVersion;
use App\Models\TestSection;
use App\Services\DistributionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestVersionController extends Controller
{
    protected $distributionService;

    public function __construct(DistributionService $distributionService)
    {
        $this->distributionService = $distributionService;
    }

    public function index()
    {
        $versions = TestVersion::latest()->paginate(15);
        return view('admin.test-versions.index', compact('versions'));
    }

    public function create()
    {
        $sections = TestSection::where('is_active', true)->orderBy('display_order')->get();
        return view('admin.test-versions.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'section_time_limit' => 'required|integer|min:1',
            'questions_per_section' => 'required|integer|min:1',
            'expected_candidates' => 'required|integer|min:1',
            'overlap_threshold' => 'required|integer|min:0|max:100',
            'pass_threshold' => 'required|integer|min:0|max:100',
            'status' => 'required|in:draft,active,completed,archived',
            'shuffle_questions' => 'boolean',
            'shuffle_options' => 'boolean',
            'section_ids' => 'required|array|min:1',
            'section_ids.*' => 'exists:test_sections,id',
        ]);

        $testVersion = TestVersion::create($validated);

        // Attach sections with order
        foreach ($validated['section_ids'] as $order => $sectionId) {
            DB::table('version_sections')->insert([
                'test_version_id' => $testVersion->id,
                'test_section_id' => $sectionId,
                'section_order' => $order,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('admin.test-versions.index')
            ->with('success', 'Test version created successfully.');
    }

    public function show(TestVersion $testVersion)
    {
        $testVersion->load('testSections', 'testAttempts');
        $metrics = $testVersion->calculateDistributionMetrics();
        
        return view('admin.test-versions.show', compact('testVersion', 'metrics'));
    }

    public function edit(TestVersion $testVersion)
    {
        $testVersion->load('testSections');
        $sections = TestSection::where('is_active', true)->orderBy('display_order')->get();
        return view('admin.test-versions.edit', compact('testVersion', 'sections'));
    }

    public function update(Request $request, TestVersion $testVersion)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'section_time_limit' => 'required|integer|min:1',
            'questions_per_section' => 'required|integer|min:1',
            'expected_candidates' => 'required|integer|min:1',
            'overlap_threshold' => 'required|integer|min:0|max:100',
            'pass_threshold' => 'required|integer|min:0|max:100',
            'status' => 'required|in:draft,active,completed,archived',
            'shuffle_questions' => 'boolean',
            'shuffle_options' => 'boolean',
            'section_ids' => 'required|array|min:1',
            'section_ids.*' => 'exists:test_sections,id',
        ]);

        $testVersion->update($validated);

        // Re-sync sections
        DB::table('version_sections')->where('test_version_id', $testVersion->id)->delete();
        
        foreach ($validated['section_ids'] as $order => $sectionId) {
            DB::table('version_sections')->insert([
                'test_version_id' => $testVersion->id,
                'test_section_id' => $sectionId,
                'section_order' => $order,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('admin.test-versions.index')
            ->with('success', 'Test version updated successfully.');
    }

    public function destroy(TestVersion $testVersion)
    {
        $testVersion->delete();
        return redirect()->route('admin.test-versions.index')
            ->with('success', 'Test version deleted successfully.');
    }

    public function preview(TestVersion $testVersion)
    {
        $metrics = $testVersion->calculateDistributionMetrics();
        return view('admin.test-versions.preview', compact('testVersion', 'metrics'));
    }
}