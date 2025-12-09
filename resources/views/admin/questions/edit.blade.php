@extends('layouts.admin')

@section('title', 'Edit Question')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Edit Question</h1>
    <p class="text-gray-600 mt-1">Update question details</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-4xl">
    <form action="{{ route('admin.questions.update', $question) }}" method="POST" enctype="multipart/form-data" id="questionForm">
        @csrf
        @method('PUT')
        
        <!-- Basic Info -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="test_section_id" class="block text-sm font-medium text-gray-700 mb-2">Section *</label>
                <select id="test_section_id" name="test_section_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">Select Section</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ old('test_section_id', $question->test_section_id) == $section->id ? 'selected' : '' }}>
                            {{ $section->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="question_type" class="block text-sm font-medium text-gray-700 mb-2">Question Type *</label>
                <select id="question_type" name="question_type" required onchange="toggleQuestionType()" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="mcq" {{ old('question_type', $question->question_type) == 'mcq' ? 'selected' : '' }}>MCQ (4 options)</option>
                    <option value="true_false" {{ old('question_type', $question->question_type) == 'true_false' ? 'selected' : '' }}>True/False</option>
                    <option value="matching" {{ old('question_type', $question->question_type) == 'matching' ? 'selected' : '' }}>Matching (4 pairs)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-4">
            <div>
                <label for="difficulty_level" class="block text-sm font-medium text-gray-700 mb-2">Difficulty *</label>
                <select id="difficulty_level" name="difficulty_level" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="easy" {{ old('difficulty_level', $question->difficulty_level) == 'easy' ? 'selected' : '' }}>Easy</option>
                    <option value="medium" {{ old('difficulty_level', $question->difficulty_level) == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="hard" {{ old('difficulty_level', $question->difficulty_level) == 'hard' ? 'selected' : '' }}>Hard</option>
                </select>
            </div>

            <div>
                <label for="marks" class="block text-sm font-medium text-gray-700 mb-2">Marks *</label>
                <input type="number" id="marks" name="marks" value="{{ old('marks', $question->marks) }}" required min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div class="flex items-end">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $question->is_active) ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm text-gray-700">Active</span>
                </label>
            </div>
        </div>

        <div class="mb-4">
            <label for="question_text" class="block text-sm font-medium text-gray-700 mb-2">Question Text *</label>
            <textarea id="question_text" name="question_text" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('question_text', $question->question_text) }}</textarea>
        </div>

        <div class="mb-6">
            <label for="question_image" class="block text-sm font-medium text-gray-700 mb-2">Question Image</label>
            @if($question->question_image)
                <div class="mb-2">
                    <img src="{{ Storage::url($question->question_image) }}" alt="Current" class="max-w-xs border rounded">
                    <p class="text-xs text-gray-500 mt-1">Current image (will be replaced if you upload new one)</p>
                </div>
            @endif
            <input type="file" id="question_image" name="question_image" accept="image/jpeg,image/jpg,image/png" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <!-- MCQ/True-False Options -->
        <div id="optionsSection" style="display: none;">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Options</h3>
            <div id="optionsContainer"></div>
        </div>

        <!-- Matching Pairs -->
        <div id="matchingSection" style="display: none;">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Matching Pairs</h3>
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
                Update Question
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
const questionData = @json($question);

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
    const options = questionData.options || [];
    container.innerHTML = '';
    
    for (let i = 0; i < 4; i++) {
        const option = options[i] || {};
        container.innerHTML += `
            <div class="mb-4 p-4 border border-gray-200 rounded-lg">
                <div class="flex items-start gap-4">
                    <input type="radio" name="correct_option" value="${i}" ${option.is_correct ? 'checked' : ''} required class="mt-1">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Option ${String.fromCharCode(65 + i)}</label>
                        <input type="text" name="options[${i}]" value="${option.option_text || ''}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-2">
                        ${option.option_image ? `<img src="/storage/${option.option_image}" class="max-w-xs mb-2 border rounded">` : ''}
                        <input type="file" name="option_images[${i}]" accept="image/jpeg,image/jpg,image/png" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>
            </div>
        `;
    }
}

function generateTrueFalseOptions() {
    const container = document.getElementById('optionsContainer');
    const options = questionData.options || [];
    const correctOption = options.find(o => o.is_correct);
    
    container.innerHTML = `
        <div class="space-y-4">
            <div class="p-4 border border-gray-200 rounded-lg">
                <label class="flex items-center">
                    <input type="radio" name="correct_option" value="0" ${correctOption && correctOption.option_text === 'True' ? 'checked' : ''} required class="mr-3">
                    <span class="font-medium">True</span>
                </label>
                <input type="hidden" name="options[0]" value="True">
            </div>
            <div class="p-4 border border-gray-200 rounded-lg">
                <label class="flex items-center">
                    <input type="radio" name="correct_option" value="1" ${correctOption && correctOption.option_text === 'False' ? 'checked' : ''} required class="mr-3">
                    <span class="font-medium">False</span>
                </label>
                <input type="hidden" name="options[1]" value="False">
            </div>
        </div>
    `;
}

function generateMatchingPairs() {
    const columnA = document.getElementById('columnAContainer');
    const columnB = document.getElementById('columnBContainer');
    const pairs = questionData.matching_pairs || [];
    
    columnA.innerHTML = '';
    columnB.innerHTML = '';
    
    for (let i = 0; i < 4; i++) {
        const pair = pairs[i] || {};
        columnA.innerHTML += `
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">${i + 1}.</label>
                <input type="text" name="column_a[${i}]" value="${pair.column_a_text || ''}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        `;
        
        columnB.innerHTML += `
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">${String.fromCharCode(65 + i)}.</label>
                <input type="text" name="column_b[${i}]" value="${pair.column_b_text || ''}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        `;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleQuestionType();
});
</script>
@endpush
@endsection