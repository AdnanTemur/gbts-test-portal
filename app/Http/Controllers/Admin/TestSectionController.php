<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestSection;
use Illuminate\Http\Request;

class TestSectionController extends Controller
{
    public function index()
    {
        $sections = TestSection::orderBy('display_order')->get();
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'display_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        TestSection::create($validated);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section created successfully.');
    }

    public function edit(TestSection $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(Request $request, TestSection $section)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'display_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $section->update($validated);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(TestSection $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')
            ->with('success', 'Section deleted successfully.');
    }
}