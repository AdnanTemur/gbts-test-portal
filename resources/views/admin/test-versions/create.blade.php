@extends('layouts.admin')

@section('title', 'Create Test Version')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-army-green-700">Create Test Version</h1>
                <p class="text-sm text-gray-600 mt-1">Configure a new test version</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Card Header -->
        <div class="px-5 py-3 bg-gradient-to-r from-army-green-700 to-army-green-600 border-b border-army-green-800">
            <h2 class="text-base font-semibold text-white">Test Version Details</h2>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.test-versions.store') }}" method="POST" class="p-5">
            @csrf
            
            <!-- Basic Information -->
            <div class="mb-5">
                <h3 class="text-base font-bold text-gray-900 mb-3 pb-2 border-b border-gray-200">Basic Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Test Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               required
                               placeholder="e.g., Mock Initial PMA Long Test - December 2024"
                               class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                        @error('title')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="2" 
                                  placeholder="Optional description for this test version..."
                                  class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Test Configuration -->
            <div class="mb-5">
                <h3 class="text-base font-bold text-gray-900 mb-3 pb-2 border-b border-gray-200">Test Configuration</h3>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="section_time_limit" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Time Limit/Section (min) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="section_time_limit" 
                                   name="section_time_limit" 
                                   value="{{ old('section_time_limit', 15) }}"
                                   required
                                   min="1"
                                   placeholder="15"
                                   class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                            <p class="text-xs text-gray-500 mt-1">Same time for all sections</p>
                        </div>

                        <div>
                            <label for="questions_per_section" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Questions/Section <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="questions_per_section" 
                                   name="questions_per_section" 
                                   value="{{ old('questions_per_section', 10) }}"
                                   required
                                   min="1"
                                   placeholder="10"
                                   class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                            <p class="text-xs text-gray-500 mt-1">Same count for all sections</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="expected_candidates" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Expected Candidates <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="expected_candidates" 
                                   name="expected_candidates" 
                                   value="{{ old('expected_candidates', 50) }}"
                                   required
                                   min="1"
                                   placeholder="50"
                                   class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                            <p class="text-xs text-gray-500 mt-1">For distribution</p>
                        </div>

                        <div>
                            <label for="overlap_threshold" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Overlap (%) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="overlap_threshold" 
                                   name="overlap_threshold" 
                                   value="{{ old('overlap_threshold', 20) }}"
                                   required
                                   min="0"
                                   max="100"
                                   placeholder="20"
                                   class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                            <p class="text-xs text-gray-500 mt-1">Max overlap</p>
                        </div>

                        <div>
                            <label for="pass_threshold" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Pass (%) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="pass_threshold" 
                                   name="pass_threshold" 
                                   value="{{ old('pass_threshold', 60) }}"
                                   required
                                   min="0"
                                   max="100"
                                   placeholder="60"
                                   class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                            <p class="text-xs text-gray-500 mt-1">Min to pass</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="shuffle_questions" value="1" 
                                       {{ old('shuffle_questions', true) ? 'checked' : '' }}
                                       class="w-4 h-4 text-army-green-700 border-gray-300 rounded focus:ring-army-green-600">
                                <span class="ml-2 text-sm font-medium text-gray-900">Shuffle questions</span>
                            </label>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="shuffle_options" value="1" 
                                       {{ old('shuffle_options', true) ? 'checked' : '' }}
                                       class="w-4 h-4 text-army-green-700 border-gray-300 rounded focus:ring-army-green-600">
                                <span class="ml-2 text-sm font-medium text-gray-900">Shuffle options/pairs</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Order -->
            <div class="mb-5">
                <h3 class="text-base font-bold text-gray-900 mb-1 pb-2 border-b border-gray-200">
                    Section Order <span class="text-red-500">*</span>
                </h3>
                <p class="text-xs text-gray-600 mb-3">Drag and drop to reorder sections</p>
                
                <div id="sectionsContainer" class="space-y-2">
                    @foreach($sections as $index => $section)
                        <div class="flex items-center p-3 bg-gray-50 border-2 border-gray-300 rounded-lg cursor-move hover:border-army-green-400 transition-colors" draggable="true">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                            </svg>
                            <input type="hidden" name="section_ids[]" value="{{ $section->id }}">
                            <div class="flex-1">
                                <span class="text-sm font-semibold text-gray-900">{{ $section->name }}</span>
                                <span class="text-xs text-gray-500 ml-2">({{ $section->activeQuestions()->count() }} questions)</span>
                            </div>
                            <div class="flex items-center px-2.5 py-1 bg-army-green-100 rounded-md">
                                <span class="text-xs text-army-green-800">Order: <span class="font-bold">{{ $index + 1 }}</span></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Status -->
            <div class="mb-5">
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" name="status" required 
                        class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none">
                    <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Only "Active" tests will be visible to candidates</p>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-5 mt-5 border-t border-gray-200">
                <a href="{{ route('admin.test-versions.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-5 py-2 text-sm bg-gradient-to-r from-army-green-700 to-army-green-600 hover:from-army-green-800 hover:to-army-green-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Test Version
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
const container = document.getElementById('sectionsContainer');
let draggedElement = null;

container.addEventListener('dragstart', function(e) {
    if (e.target.draggable) {
        draggedElement = e.target;
        e.target.style.opacity = '0.5';
    }
});

container.addEventListener('dragend', function(e) {
    if (e.target.draggable) {
        e.target.style.opacity = '';
    }
});

container.addEventListener('dragover', function(e) {
    e.preventDefault();
});

container.addEventListener('drop', function(e) {
    e.preventDefault();
    if (e.target.closest('[draggable="true"]') && draggedElement) {
        const dropTarget = e.target.closest('[draggable="true"]');
        if (dropTarget && dropTarget !== draggedElement) {
            container.insertBefore(draggedElement, dropTarget);
            updateOrderNumbers();
        }
    }
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