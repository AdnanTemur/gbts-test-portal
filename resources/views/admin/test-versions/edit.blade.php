@extends('layouts.admin')

@section('title', 'Edit Test Version')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-primary-700">Edit Test Version</h1>
                <p class="text-sm text-gray-600 mt-1">{{ $testVersion->version_code }}</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Card Header -->
        <div class="px-5 py-3 bg-gradient-to-r from-primary-700 to-primary-600 border-b border-primary-800">
            <h2 class="text-base font-semibold text-white">Test Version Details</h2>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.test-versions.update', $testVersion) }}" method="POST" class="p-5">
            @csrf
            @method('PUT')
            
            <!-- Basic Information -->
            <div class="mb-5">
                <h3 class="text-base font-bold text-gray-900 mb-3 pb-2 border-b border-gray-200">Basic Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Version Code</label>
                        <input type="text" value="{{ $testVersion->version_code }}" disabled 
                               class="w-full px-3 py-2 text-sm border-2 border-gray-200 rounded-lg bg-gray-50 text-gray-600">
                        <p class="text-xs text-gray-500 mt-1">Version code cannot be changed</p>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Test Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $testVersion->title) }}"
                               required
                               placeholder="e.g., Long Test 2025"
                               class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">
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
                                  class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">{{ old('description', $testVersion->description) }}</textarea>
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
                                   value="{{ old('section_time_limit', $testVersion->section_time_limit) }}"
                                   required
                                   min="1"
                                   placeholder="20"
                                   class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">
                        </div>

                        <div>
                            <label for="questions_per_section" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Questions/Section <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="questions_per_section" 
                                   name="questions_per_section" 
                                   value="{{ old('questions_per_section', $testVersion->questions_per_section) }}"
                                   required
                                   min="1"
                                   placeholder="50"
                                   class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">
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
                                   value="{{ old('expected_candidates', $testVersion->expected_candidates) }}"
                                   required
                                   min="1"
                                   placeholder="100"
                                   class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">
                        </div>

                        <div>
                            <label for="overlap_threshold" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Overlap (%) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="overlap_threshold" 
                                   name="overlap_threshold" 
                                   value="{{ old('overlap_threshold', $testVersion->overlap_threshold) }}"
                                   required
                                   min="0"
                                   max="100"
                                   placeholder="30"
                                   class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">
                        </div>

                        <div>
                            <label for="pass_threshold" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Pass (%) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="pass_threshold" 
                                   name="pass_threshold" 
                                   value="{{ old('pass_threshold', $testVersion->pass_threshold) }}"
                                   required
                                   min="0"
                                   max="100"
                                   placeholder="60"
                                   class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="shuffle_questions" value="1" 
                                       {{ old('shuffle_questions', $testVersion->shuffle_questions) ? 'checked' : '' }}
                                       class="w-4 h-4 text-primary-700 border-gray-300 rounded focus:ring-primary-600">
                                <span class="ml-2 text-sm font-medium text-gray-900">Shuffle questions</span>
                            </label>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="shuffle_options" value="1" 
                                       {{ old('shuffle_options', $testVersion->shuffle_options) ? 'checked' : '' }}
                                       class="w-4 h-4 text-primary-700 border-gray-300 rounded focus:ring-primary-600">
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
                <p class="text-xs text-gray-600 mb-3">Check sections to include. Drag to reorder.</p>

                @error('section_ids')
                    <p class="mb-2 text-xs text-red-600">{{ $message }}</p>
                @enderror

                <div id="sectionsContainer" class="space-y-2">
                    @php
                        $currentSections = $testVersion->testSections->sortBy('pivot.section_order');
                        $currentSectionIds = $currentSections->pluck('id')->toArray();
                        $oldSectionIds = old('section_ids');

                        // Determine which IDs to treat as selected
                        $selectedIds = $oldSectionIds ?? $currentSectionIds;

                        // Build ordered list: selected sections first (in their order), then unselected
                        $selectedSections = $currentSections; // already ordered by pivot
                        $unselectedSections = $sections->whereNotIn('id', $currentSectionIds);
                    @endphp

                    {{-- Selected sections first (in saved order) --}}
                    @foreach($selectedSections as $index => $section)
                        <div class="flex items-center p-3 bg-gray-50 border-2 border-gray-300 rounded-lg hover:border-primary-400 transition-colors section-item"
                            draggable="true"
                            data-id="{{ $section->id }}">

                            <svg class="drag-handle w-5 h-5 text-gray-400 mr-2 cursor-move" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                            </svg>

                            <input type="checkbox"
                                name="section_ids[]"
                                value="{{ $section->id }}"
                                {{ in_array($section->id, $selectedIds) ? 'checked' : '' }}
                                class="section-checkbox w-4 h-4 text-primary-700 border-gray-300 rounded focus:ring-primary-600 mr-3 cursor-pointer">

                            <div class="flex-1">
                                <span class="text-sm font-semibold text-gray-900">{{ $section->name }}</span>
                                <span class="text-xs text-gray-500 ml-2">({{ $section->activeQuestions()->count() }} questions)</span>
                            </div>

                            <div class="order-badge flex items-center px-2.5 py-1 bg-primary-100 rounded-md">
                                <span class="text-xs text-primary-800">Order: <span class="order-number font-bold">{{ $index + 1 }}</span></span>
                            </div>
                        </div>
                    @endforeach

                    {{-- Unselected sections at the bottom --}}
                    @foreach($unselectedSections as $section)
                        <div class="flex items-center p-3 bg-gray-50 border-2 border-gray-300 rounded-lg hover:border-primary-400 transition-colors section-item opacity-50"
                            draggable="false"
                            data-id="{{ $section->id }}">

                            <svg class="drag-handle w-5 h-5 text-gray-300 mr-2 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/>
                            </svg>

                            <input type="checkbox"
                                name="section_ids[]"
                                value="{{ $section->id }}"
                                class="section-checkbox w-4 h-4 text-primary-700 border-gray-300 rounded focus:ring-primary-600 mr-3 cursor-pointer">

                            <div class="flex-1">
                                <span class="text-sm font-semibold text-gray-900">{{ $section->name }}</span>
                                <span class="text-xs text-gray-500 ml-2">({{ $section->activeQuestions()->count() }} questions)</span>
                            </div>

                            <div class="order-badge flex items-center px-2.5 py-1 bg-gray-100 rounded-md">
                                <span class="text-xs text-gray-500">Order: <span class="order-number font-bold">-</span></span>
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
                        class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">
                    <option value="draft" {{ old('status', $testVersion->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="active" {{ old('status', $testVersion->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ old('status', $testVersion->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="archived" {{ old('status', $testVersion->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
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
                        class="inline-flex items-center px-5 py-2 text-sm bg-gradient-to-r from-primary-700 to-primary-600 hover:from-primary-800 hover:to-primary-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Test Version
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
const container = document.getElementById('sectionsContainer');
let draggedElement = null;

// Toggle draggable and drag handle on checkbox change
container.addEventListener('change', function(e) {
    if (e.target.classList.contains('section-checkbox')) {
        const item = e.target.closest('.section-item');
        const handle = item.querySelector('.drag-handle');
        const badge = item.querySelector('.order-badge');

        if (e.target.checked) {
            item.setAttribute('draggable', 'true');
            item.classList.remove('opacity-50');
            handle.classList.remove('hidden');
            // Move to just before the first unchecked item
            const firstUnchecked = [...container.querySelectorAll('.section-item')]
                .find(el => !el.querySelector('.section-checkbox').checked);
            if (firstUnchecked) {
                container.insertBefore(item, firstUnchecked);
            } else {
                container.appendChild(item);
            }
        } else {
            item.setAttribute('draggable', 'false');
            item.classList.add('opacity-50');
            handle.classList.add('hidden');
            // Move to end
            container.appendChild(item);
        }

        updateOrderNumbers();
    }
});

// Drag events
container.addEventListener('dragstart', function(e) {
    const item = e.target.closest('[draggable="true"]');
    if (item) {
        draggedElement = item;
        setTimeout(() => item.style.opacity = '0.4', 0);
    }
});

container.addEventListener('dragend', function(e) {
    const item = e.target.closest('.section-item');
    if (item) {
        item.style.opacity = item.querySelector('.section-checkbox').checked ? '' : '0.5';
        draggedElement = null;
    }
});

container.addEventListener('dragover', function(e) {
    e.preventDefault();
    const overItem = e.target.closest('[draggable="true"]');
    if (overItem && draggedElement && overItem !== draggedElement) {
        const rect = overItem.getBoundingClientRect();
        const midY = rect.top + rect.height / 2;
        if (e.clientY < midY) {
            container.insertBefore(draggedElement, overItem);
        } else {
            container.insertBefore(draggedElement, overItem.nextSibling);
        }
        updateOrderNumbers();
    }
});

container.addEventListener('drop', function(e) {
    e.preventDefault();
});

function updateOrderNumbers() {
    let order = 1;
    container.querySelectorAll('.section-item').forEach(item => {
        const badge = item.querySelector('.order-badge');
        const orderNum = item.querySelector('.order-number');
        if (item.querySelector('.section-checkbox').checked) {
            orderNum.textContent = order++;
            badge.className = 'order-badge flex items-center px-2.5 py-1 bg-primary-100 rounded-md';
            badge.querySelector('span').className = 'text-xs text-primary-800';
        } else {
            orderNum.textContent = '-';
            badge.className = 'order-badge flex items-center px-2.5 py-1 bg-gray-100 rounded-md';
            badge.querySelector('span').className = 'text-xs text-gray-500';
        }
    });
}
</script>
@endpush
@endsection