@extends('layouts.admin')

@section('title', 'Create Question')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Create New Question</h1>
    <p class="text-gray-600 mt-1">Add a new question to the question bank</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-4xl">
    <form action="{{ route('admin.questions.store') }}" method="POST" enctype="multipart/form-data" id="questionForm">
        @csrf
        
        <!-- Basic Info -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="test_section_id" class="block text-sm font-medium text-gray-700 mb-2">Section *</label>
                <select id="test_section_id" name="test_section_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">Select Section</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ old('test_section_id') == $section->id ? 'selected' : '' }}>
                            {{ $section->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="question_type" class="block text-sm font-medium text-gray-700 mb-2">Question Type *</label>
                <select id="question_type" name="question_type" required onchange="toggleQuestionType()" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">Select Type</option>
                    <option value="mcq" {{ old('question_type') == 'mcq' ? 'selected' : '' }}>MCQ (4 options)</option>
                    <option value="true_false" {{ old('question_type') == 'true_false' ? 'selected' : '' }}>True/False</option>
                    <option value="matching" {{ old('question_type') == 'matching' ? 'selected' : '' }}>Matching (4 pairs)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label for="difficulty_level" class="block text-sm font-medium text-gray-700 mb-2">Difficulty *</label>
                <select id="difficulty_level" name="difficulty_level" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="easy" {{ old('difficulty_level') == 'easy' ? 'selected' : '' }}>Easy</option>
                    <option value="medium" {{ old('difficulty_level', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="hard" {{ old('difficulty_level') == 'hard' ? 'selected' : '' }}>Hard</option>
                </select>
            </div>

            <div>
                <label for="marks" class="block text-sm font-medium text-gray-700 mb-2">Marks *</label>
                <input type="number" id="marks" name="marks" value="{{ old('marks', 1) }}" required min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div class="flex items-end">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm text-gray-700">Active</span>
                </label>
            </div>
        </div>

        <div class="mb-4">
            <label for="question_text" class="block text-sm font-medium text-gray-700 mb-2">Question Text *</label>
            <textarea id="question_text" name="question_text" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('question_text') }}</textarea>
        </div>

        <div class="mb-6">
            <label for="question_image" class="block text-sm font-medium text-gray-700 mb-2">Question Image (Optional, for Non-Verbal)</label>
            <input type="file" id="question_image" name="question_image" accept="image/jpeg,image/jpg,image/png" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            <p class="text-xs text-gray-500 mt-1">Max 2MB, JPG/PNG only</p>
        </div>

        <!-- MCQ/True-False Options -->
        <div id="optionsSection" style="display: none;">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Options</h3>
            <div id="optionsContainer"></div>
        </div>

        <!-- Matching Pairs -->
        <div id="matchingSection" style="display: none;">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Matching Pairs (4 pairs required)</h3>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h4 class="font-semibold mb-2">Column A</h4>
                    <div id="columnAContainer"></div>
                </div>
                <div>
                    <h4 class="font-semibold mb-2">Column B</h4>
                    <div id="columnBContainer"></div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mt-6 pt-6 border-t">
            <a href="{{ route('admin.questions.index') }}" class="text-gray-600 hover:text-gray-900">
                ← Back to Questions
            </a>
            <button type="submit" class="bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-2 px-6 rounded-lg">
                Create Question
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
function toggleQuestionType() {
    const type = document.getElementById('question_type').value;
    const optionsSection = document.getElementById('optionsSection');
    const matchingSection = document.getElementById('matchingSection');
    
    optionsSection.style.display = 'none';
    matchingSection.style.display = 'none';
    
    if (type === 'mcq') {
        optionsSection.style.display = 'block';
        generateMCQOptions();
    } else if (type === 'true_false') {
        optionsSection.style.display = 'block';
        generateTrueFalseOptions();
    } else if (type === 'matching') {
        matchingSection.style.display = 'block';
        generateMatchingPairs();
    }
}

function generateMCQOptions() {
    const container = document.getElementById('optionsContainer');
    container.innerHTML = '';
    
    for (let i = 0; i < 4; i++) {
        container.innerHTML += `
            <div class="mb-4 p-4 border border-gray-200 rounded-lg">
                <div class="flex items-start gap-4">
                    <input type="radio" name="correct_option" value="${i}" required class="mt-1">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Option ${String.fromCharCode(65 + i)}</label>
                        <input type="text" name="options[${i}]" required placeholder="Enter option text" class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-2">
                        <input type="file" name="option_images[${i}]" accept="image/jpeg,image/jpg,image/png" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <p class="text-xs text-gray-500 mt-1">Optional image for this option</p>
                    </div>
                </div>
            </div>
        `;
    }
    container.innerHTML += '<p class="text-sm text-blue-600 mt-2">Select the correct answer using the radio buttons</p>';
}

function generateTrueFalseOptions() {
    const container = document.getElementById('optionsContainer');
    container.innerHTML = `
        <div class="space-y-4">
            <div class="p-4 border border-gray-200 rounded-lg">
                <label class="flex items-center">
                    <input type="radio" name="correct_option" value="0" required class="mr-3">
                    <span class="font-medium">True</span>
                </label>
                <input type="hidden" name="options[0]" value="True">
            </div>
            <div class="p-4 border border-gray-200 rounded-lg">
                <label class="flex items-center">
                    <input type="radio" name="correct_option" value="1" required class="mr-3">
                    <span class="font-medium">False</span>
                </label>
                <input type="hidden" name="options[1]" value="False">
            </div>
        </div>
        <p class="text-sm text-blue-600 mt-2">Select the correct answer</p>
    `;
}

function generateMatchingPairs() {
    const columnA = document.getElementById('columnAContainer');
    const columnB = document.getElementById('columnBContainer');
    
    columnA.innerHTML = '';
    columnB.innerHTML = '';
    
    for (let i = 0; i < 4; i++) {
        columnA.innerHTML += `
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">${i + 1}.</label>
                <input type="text" name="column_a[${i}]" required placeholder="Item ${i + 1}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        `;
        
        columnB.innerHTML += `
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">${String.fromCharCode(65 + i)}.</label>
                <input type="text" name="column_b[${i}]" required placeholder="Match for item ${i + 1}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        `;
    }
    
    columnB.innerHTML += '<p class="text-xs text-gray-500 mt-2">Column B will be shuffled for candidates. Make sure each item in Column A has its correct match in Column B at the same index.</p>';
}

// Initialize on page load if type is already selected
document.addEventListener('DOMContentLoaded', function() {
    const type = document.getElementById('question_type').value;
    if (type) {
        toggleQuestionType();
    }
});
</script>
@endpush
@endsection