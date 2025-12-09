@extends('layouts.admin')

@section('title', 'Create Test Version')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Create New Test Version</h1>
    <p class="text-gray-600 mt-1">Configure a new test version</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-4xl">
    <form action="{{ route('admin.test-versions.store') }}" method="POST">
        @csrf
        
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Basic Information</h3>
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Test Title *</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}"
                       required
                       placeholder="e.g., Mock Initial PMA Long Test - December 2024"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea id="description" 
                          name="description" 
                          rows="3" 
                          placeholder="Optional description"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Test Configuration</h3>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="section_time_limit" class="block text-sm font-medium text-gray-700 mb-2">Time Limit per Section (minutes) *</label>
                    <input type="number" 
                           id="section_time_limit" 
                           name="section_time_limit" 
                           value="{{ old('section_time_limit', 15) }}"
                           required
                           min="1"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Same time limit for all sections</p>
                </div>

                <div>
                    <label for="questions_per_section" class="block text-sm font-medium text-gray-700 mb-2">Questions per Section *</label>
                    <input type="number" 
                           id="questions_per_section" 
                           name="questions_per_section" 
                           value="{{ old('questions_per_section', 10) }}"
                           required
                           min="1"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Same count for all sections</p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="expected_candidates" class="block text-sm font-medium text-gray-700 mb-2">Expected Candidates *</label>
                    <input type="number" 
                           id="expected_candidates" 
                           name="expected_candidates" 
                           value="{{ old('expected_candidates', 50) }}"
                           required
                           min="1"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">For distribution calculation</p>
                </div>

                <div>
                    <label for="overlap_threshold" class="block text-sm font-medium text-gray-700 mb-2">Overlap Threshold (%) *</label>
                    <input type="number" 
                           id="overlap_threshold" 
                           name="overlap_threshold" 
                           value="{{ old('overlap_threshold', 20) }}"
                           required
                           min="0"
                           max="100"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Maximum acceptable overlap</p>
                </div>

                <div>
                    <label for="pass_threshold" class="block text-sm font-medium text-gray-700 mb-2">Pass Threshold (%) *</label>
                    <input type="number" 
                           id="pass_threshold" 
                           name="pass_threshold" 
                           value="{{ old('pass_threshold', 60) }}"
                           required
                           min="0"
                           max="100"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-xs text-gray-500 mt-1">Minimum to pass</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="shuffle_questions" value="1" {{ old('shuffle_questions', true) ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm text-gray-700">Shuffle questions order</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="shuffle_options" value="1" {{ old('shuffle_options', true) ? 'checked' : '' }} class="mr-2">
                    <span class="text-sm text-gray-700">Shuffle options/pairs</span>
                </label>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Section Order *</h3>
            <p class="text-sm text-gray-600 mb-4">Drag to reorder sections (order in which candidates will take them)</p>
            
            <div id="sectionsContainer" class="space-y-2">
                @foreach($sections as $index => $section)
                    <div class="flex items-center p-3 bg-gray-50 border border-gray-300 rounded-lg cursor-move" draggable="true">
                        <span class="text-2xl mr-3">⋮⋮</span>
                        <input type="hidden" name="section_ids[]" value="{{ $section->id }}">
                        <div class="flex-1">
                            <span class="font-medium">{{ $section->name }}</span>
                            <span class="text-xs text-gray-500 ml-2">({{ $section->activeQuestions()->count() }} questions available)</span>
                        </div>
                        <span class="text-sm text-gray-600">Order: <span class="font-bold">{{ $index + 1 }}</span></span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
            <select id="status" name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            <p class="text-xs text-gray-500 mt-1">Only "Active" tests will be visible to candidates</p>
        </div>

        <div class="flex items-center justify-between pt-6 border-t">
            <a href="{{ route('admin.test-versions.index') }}" class="text-gray-600 hover:text-gray-900">
                ← Back to Test Versions
            </a>
            <button type="submit" class="bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-2 px-6 rounded-lg">
                Create Test Version
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Simple drag and drop for section ordering
const container = document.getElementById('sectionsContainer');
let draggedElement = null;

container.addEventListener('dragstart', function(e) {
    draggedElement = e.target;
    e.target.style.opacity = '0.5';
});

container.addEventListener('dragend', function(e) {
    e.target.style.opacity = '';
});

container.addEventListener('dragover', function(e) {
    e.preventDefault();
});

container.addEventListener('drop', function(e) {
    e.preventDefault();
    if (e.target.className.includes('cursor-move')) {
        container.insertBefore(draggedElement, e.target);
    }
    updateOrderNumbers();
});

function updateOrderNumbers() {
    const items = container.querySelectorAll('[draggable="true"]');
    items.forEach((item, index) => {
        item.querySelector('span.font-bold').textContent = index + 1;
    });
}
</script>
@endpush
@endsection