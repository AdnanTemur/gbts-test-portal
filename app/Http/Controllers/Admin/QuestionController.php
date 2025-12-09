<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\TestSection;
use App\Models\QuestionOption;
use App\Models\MatchingPair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with('testSection');

        if ($request->filled('section_id')) {
            $query->where('test_section_id', $request->section_id);
        }

        if ($request->filled('question_type')) {
            $query->where('question_type', $request->question_type);
        }

        $questions = $query->latest()->paginate(20);
        $sections = TestSection::all();

        return view('admin.questions.index', compact('questions', 'sections'));
    }

    public function create()
    {
        $sections = TestSection::where('is_active', true)->get();
        return view('admin.questions.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'test_section_id' => 'required|exists:test_sections,id',
            'question_type' => 'required|in:mcq,true_false,matching',
            'question_text' => 'required|string',
            'question_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'difficulty_level' => 'required|in:easy,medium,hard',
            'marks' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        // Handle question image upload
        if ($request->hasFile('question_image')) {
            $validated['question_image'] = $request->file('question_image')->store('questions', 'public');
        }

        $question = Question::create($validated);

        // Handle options for MCQ/True-False
        if (in_array($validated['question_type'], ['mcq', 'true_false'])) {
            $options = $request->input('options', []);
            $correctOption = $request->input('correct_option');

            foreach ($options as $index => $optionData) {
                $optionImage = null;
                if ($request->hasFile("option_images.$index")) {
                    $optionImage = $request->file("option_images.$index")->store('questions', 'public');
                }

                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $optionData,
                    'option_image' => $optionImage,
                    'is_correct' => $index == $correctOption,
                    'display_order' => $index,
                ]);
            }
        }

        // Handle matching pairs
        if ($validated['question_type'] === 'matching') {
            $columnA = $request->input('column_a', []);
            $columnB = $request->input('column_b', []);
            $keys = ['A', 'B', 'C', 'D'];

            foreach ($columnA as $index => $aText) {
                MatchingPair::create([
                    'question_id' => $question->id,
                    'column_a_text' => $aText,
                    'column_b_text' => $columnB[$index],
                    'column_b_key' => $keys[$index],
                    'pair_order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question created successfully.');
    }

    public function edit(Question $question)
    {
        $question->load('options', 'matchingPairs');
        $sections = TestSection::where('is_active', true)->get();
        return view('admin.questions.edit', compact('question', 'sections'));
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'test_section_id' => 'required|exists:test_sections,id',
            'question_type' => 'required|in:mcq,true_false,matching',
            'question_text' => 'required|string',
            'question_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'difficulty_level' => 'required|in:easy,medium,hard',
            'marks' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        // Handle question image upload
        if ($request->hasFile('question_image')) {
            if ($question->question_image) {
                Storage::disk('public')->delete($question->question_image);
            }
            $validated['question_image'] = $request->file('question_image')->store('questions', 'public');
        }

        $question->update($validated);

        // Delete old options/pairs
        $question->options()->delete();
        $question->matchingPairs()->delete();

        // Re-create options/pairs (same logic as store)
        if (in_array($validated['question_type'], ['mcq', 'true_false'])) {
            $options = $request->input('options', []);
            $correctOption = $request->input('correct_option');

            foreach ($options as $index => $optionData) {
                $optionImage = null;
                if ($request->hasFile("option_images.$index")) {
                    $optionImage = $request->file("option_images.$index")->store('questions', 'public');
                }

                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $optionData,
                    'option_image' => $optionImage,
                    'is_correct' => $index == $correctOption,
                    'display_order' => $index,
                ]);
            }
        }

        if ($validated['question_type'] === 'matching') {
            $columnA = $request->input('column_a', []);
            $columnB = $request->input('column_b', []);
            $keys = ['A', 'B', 'C', 'D'];

            foreach ($columnA as $index => $aText) {
                MatchingPair::create([
                    'question_id' => $question->id,
                    'column_a_text' => $aText,
                    'column_b_text' => $columnB[$index],
                    'column_b_key' => $keys[$index],
                    'pair_order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        if ($question->question_image) {
            Storage::disk('public')->delete($question->question_image);
        }
        $question->delete();
        return redirect()->route('admin.questions.index')
            ->with('success', 'Question deleted successfully.');
    }
}