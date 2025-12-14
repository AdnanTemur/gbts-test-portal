@extends('layouts.admin')

@section('title', 'Create Question')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Create New Question</h1>
                    <p class="text-sm text-gray-600 mt-1">Add a new question to the question bank</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <!-- Card Header -->
            <div class="px-5 py-3 bg-gradient-to-r from-army-green-700 to-army-green-600 border-b border-army-green-800">
                <h2 class="text-base font-semibold text-white">Question Details</h2>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.questions.store') }}" method="POST" enctype="multipart/form-data"
                id="questionForm" class="p-5">
                @csrf

                <!-- Basic Info Grid -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="test_section_id" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Section <span class="text-red-500">*</span>
                        </label>
                        <select id="test_section_id" name="test_section_id" required
                            class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                            <option value="">Select Section</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('test_section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('test_section_id')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="question_type" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Question Type <span class="text-red-500">*</span>
                        </label>
                        <select id="question_type" name="question_type" required onchange="toggleQuestionType()"
                            class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                            <option value="">Select Type</option>
                            <option value="mcq" {{ old('question_type') == 'mcq' ? 'selected' : '' }}>MCQ (4 options)</option>
                            <option value="true_false" {{ old('question_type') == 'true_false' ? 'selected' : '' }}>True/False
                            </option>
                            <option value="matching" {{ old('question_type') == 'matching' ? 'selected' : '' }}>Matching (4
                                pairs)</option>
                        </select>
                        @error('question_type')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Settings Grid -->
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label for="difficulty_level" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Difficulty <span class="text-red-500">*</span>
                        </label>
                        <select id="difficulty_level" name="difficulty_level" required
                            class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                            <option value="easy" {{ old('difficulty_level') == 'easy' ? 'selected' : '' }}>Easy</option>
                            <option value="medium" {{ old('difficulty_level', 'medium') == 'medium' ? 'selected' : '' }}>
                                Medium</option>
                            <option value="hard" {{ old('difficulty_level') == 'hard' ? 'selected' : '' }}>Hard</option>
                        </select>
                    </div>

                    <div>
                        <label for="marks" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Marks <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="marks" name="marks" value="{{ old('marks', 1) }}" required min="1"
                            class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                    </div>

                    <div class="flex items-end">
                        <div class="bg-gray-50 rounded-lg p-2.5 border border-gray-200 w-full">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                    class="w-4 h-4 text-army-green-700 border-gray-300 rounded focus:ring-army-green-600">
                                <span class="ml-2 text-sm font-medium text-gray-900">Active</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Question Text -->
                <div class="mb-4">
                    <label for="question_text" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Question Text <span class="text-red-500">*</span>
                    </label>
                    <textarea id="question_text" name="question_text" rows="3" required
                        placeholder="Enter the question text here..."
                        class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">{{ old('question_text') }}</textarea>
                    @error('question_text')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Question Image -->
                <div class="mb-5">
                    <label for="question_image" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Question Image <span class="text-gray-500 text-xs">(Optional, for Non-Verbal)</span>
                    </label>
                    <input type="file" id="question_image" name="question_image" accept="image/jpeg,image/jpg,image/png"
                        class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB, JPG/PNG only</p>
                </div>

                <!-- MCQ/True-False Options -->
                <div id="optionsSection" style="display: none;">
                    <div class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="text-base font-bold text-gray-900 mb-3">Answer Options</h3>
                    </div>
                    <div id="optionsContainer" class="space-y-3"></div>
                </div>

                <!-- Matching Pairs -->
                <div id="matchingSection" style="display: none;">
                    <div class="mb-4 pb-4 border-b border-gray-200">
                        <h3 class="text-base font-bold text-gray-900 mb-1">Matching Pairs</h3>
                        <p class="text-xs text-gray-600">Create 4 matching pairs (Column A items will match with Column B
                            items)</p>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Column A</h4>
                            <div id="columnAContainer" class="space-y-3"></div>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Column B</h4>
                            <div id="columnBContainer" class="space-y-3"></div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-5 mt-5 border-t border-gray-200">
                    <a href="{{ route('admin.questions.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2 text-sm bg-gradient-to-r from-army-green-700 to-army-green-600 hover:from-army-green-800 hover:to-army-green-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Question
                    </button>
                </div>
            </form>
        </div>
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
                    <div class="p-3 border-2 border-gray-200 rounded-lg hover:border-army-green-300 transition-colors">
                        <div class="flex items-start gap-3">
                            <input type="radio" name="correct_option" value="${i}" required class="mt-2 w-4 h-4 text-army-green-700">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Option ${String.fromCharCode(65 + i)}</label>
                                <input type="text" name="options[${i}]" required placeholder="Enter option text" 
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none mb-2">
                                <input type="file" name="option_images[${i}]" accept="image/jpeg,image/jpg,image/png" 
                                       class="w-full px-3 py-1.5 text-xs border border-gray-300 rounded-lg">
                                <p class="text-xs text-gray-500 mt-1">Optional image for this option (Max 2MB)</p>
                            </div>
                        </div>
                    </div>
                `;
                }
                container.innerHTML += '<div class="mt-3 p-3 bg-blue-50 border-l-4 border-blue-400 rounded-r-lg"><p class="text-xs text-blue-700"><strong>Note:</strong> Select the correct answer using the radio buttons above</p></div>';
            }

            function generateTrueFalseOptions() {
                const container = document.getElementById('optionsContainer');
                container.innerHTML = `
                <div class="space-y-3">
                    <div class="p-3 border-2 border-gray-200 rounded-lg hover:border-army-green-300 transition-colors">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="correct_option" value="0" required class="w-4 h-4 text-army-green-700 mr-3">
                            <span class="text-sm font-semibold text-gray-900">True</span>
                        </label>
                        <input type="hidden" name="options[0]" value="True">
                    </div>
                    <div class="p-3 border-2 border-gray-200 rounded-lg hover:border-army-green-300 transition-colors">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="correct_option" value="1" required class="w-4 h-4 text-army-green-700 mr-3">
                            <span class="text-sm font-semibold text-gray-900">False</span>
                        </label>
                        <input type="hidden" name="options[1]" value="False">
                    </div>
                </div>
                <div class="mt-3 p-3 bg-blue-50 border-l-4 border-blue-400 rounded-r-lg"><p class="text-xs text-blue-700"><strong>Note:</strong> Select the correct answer above</p></div>
            `;
            }

            function generateMatchingPairs() {
                const columnA = document.getElementById('columnAContainer');
                const columnB = document.getElementById('columnBContainer');

                columnA.innerHTML = '';
                columnB.innerHTML = '';

                for (let i = 0; i < 4; i++) {
                    columnA.innerHTML += `
                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <label class="block text-xs font-bold text-gray-600 mb-1.5">${i + 1}.</label>
                        <input type="text" name="column_a[${i}]" required placeholder="Item ${i + 1}" 
                               class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                    </div>
                `;

                    columnB.innerHTML += `
                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <label class="block text-xs font-bold text-gray-600 mb-1.5">${String.fromCharCode(65 + i)}.</label>
                        <input type="text" name="column_b[${i}]" required placeholder="Match for item ${i + 1}" 
                               class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                    </div>
                `;
                }

                columnB.innerHTML += '<div class="mt-3 p-3 bg-blue-50 border-l-4 border-blue-400 rounded-r-lg"><p class="text-xs text-blue-700"><strong>Note:</strong> Column B will be shuffled for candidates. Ensure each Column A item matches its corresponding Column B item at the same index.</p></div>';
            }

            // Initialize on page load if type is already selected
            document.addEventListener('DOMContentLoaded', function () {
                const type = document.getElementById('question_type').value;
                if (type) {
                    toggleQuestionType();
                }
            });
        </script>
    @endpush
@endsection