@extends('layouts.app')

@section('title', 'Test Section - PMA Test Portal')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Timer -->
    <div x-data="initSectionTimer('{{ $endTime->toIso8601String() }}')" 
         class="section-timer"
         :class="isWarning() ? 'bg-red-100 border-red-500' : 'bg-white'">
        <div class="text-sm font-medium mb-1" :class="isWarning() ? 'text-red-800' : 'text-gray-600'">
            Time Remaining
        </div>
        <div class="text-3xl font-bold" :class="isWarning() ? 'text-red-600' : 'text-army-green-700'" x-text="formatTime()"></div>
        <div class="text-xs mt-1" :class="isWarning() ? 'text-red-600' : 'text-gray-500'">
            {{ $currentSection->testSection->name }}
        </div>
    </div>

    <!-- Section Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-army-green-900">
                    Section {{ $currentSection->section_order + 1 }}: {{ $currentSection->testSection->name }}
                </h1>
                <p class="text-gray-600 mt-1">
                    Questions {{ ($currentSection->section_order * $testAttempt->testVersion->questions_per_section) + 1 }} - 
                    {{ ($currentSection->section_order + 1) * $testAttempt->testVersion->questions_per_section }}
                </p>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold text-army-green-700">
                    {{ $questions->count() }}
                </div>
                <div class="text-sm text-gray-600">Questions</div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="mt-4">
            <div class="bg-gray-200 rounded-full h-2">
                <div class="bg-army-green-600 rounded-full h-2 transition-all" 
                     style="width: {{ (($currentSection->section_order + 1) / $testAttempt->sectionAttempts->count()) * 100 }}%"></div>
            </div>
            <div class="text-xs text-gray-600 mt-1">
                Section {{ $currentSection->section_order + 1 }} of {{ $testAttempt->sectionAttempts->count() }}
            </div>
        </div>
    </div>

    <!-- Questions -->
    <form id="section-form" method="POST" action="{{ route('test.nextSection', $testAttempt->attempt_token) }}">
        @csrf
        
        @foreach($questions as $index => $assignment)
            @php
                $question = $assignment->question;
                $questionNumber = ($currentSection->section_order * $testAttempt->testVersion->questions_per_section) + $index + 1;
                $existingAnswer = $existingAnswers->get($question->id);
            @endphp

            <div class="question-card mb-6" id="question-{{ $question->id }}">
                <div class="flex items-start mb-4">
                    <span class="bg-army-green-700 text-white font-bold px-4 py-2 rounded mr-4 flex-shrink-0">
                        Q{{ $questionNumber }}
                    </span>
                    <div class="flex-1">
                        <p class="text-lg text-gray-900 mb-2">{{ $question->question_text }}</p>
                        
                        @if($question->question_image)
                            <img src="{{ Storage::url($question->question_image) }}" 
                                 alt="Question Image"
                                 class="max-w-md rounded-lg border-2 border-gray-300 mb-4">
                        @endif

                        @if($question->marks > 1)
                            <p class="text-sm text-gray-600">({{ $question->marks }} marks)</p>
                        @endif
                    </div>
                </div>

                <!-- MCQ or True/False -->
                @if($question->isMCQ() || $question->isTrueFalse())
                    <div class="space-y-3 ml-20">
                        @foreach($question->options as $optIndex => $option)
                            <label class="option-button {{ $existingAnswer && $existingAnswer->selected_option_id == $option->id ? 'selected border-army-green-600 bg-army-green-100' : 'border-gray-300' }}">
                                <input type="radio" 
                                       name="question_{{ $question->id }}" 
                                       value="{{ $option->id }}"
                                       {{ $existingAnswer && $existingAnswer->selected_option_id == $option->id ? 'checked' : '' }}
                                       onchange="saveAnswer('{{ $testAttempt->attempt_token }}', {{ $question->id }}, { selected_option_id: {{ $option->id }} }); this.parentElement.parentElement.querySelectorAll('.option-button').forEach(el => el.classList.remove('selected', 'border-army-green-600', 'bg-army-green-100')); this.parentElement.classList.add('selected', 'border-army-green-600', 'bg-army-green-100');"
                                       class="mr-3">
                                <span class="font-semibold mr-2">{{ chr(65 + $optIndex) }}.</span>
                                
                                @if($option->option_image)
                                    <img src="{{ Storage::url($option->option_image) }}" 
                                         alt="Option {{ chr(65 + $optIndex) }}"
                                         class="inline-block max-w-xs rounded border ml-2">
                                @else
                                    <span>{{ $option->option_text }}</span>
                                @endif
                            </label>
                        @endforeach
                    </div>
                @endif

                <!-- Matching Questions -->
                @if($question->isMatching())
                    <div class="ml-20">
                        <p class="text-sm text-gray-600 mb-3">Match items from Column A to Column B</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Column A -->
                            <div>
                                <h4 class="font-bold text-gray-900 mb-3">Column A</h4>
                                @foreach($question->matchingPairs->sortBy('pair_order') as $pair)
                                    <div class="flex items-center mb-3 p-3 bg-gray-50 rounded">
                                        <span class="font-bold text-army-green-700 mr-3">{{ $pair->pair_order }}.</span>
                                        <span>{{ $pair->column_a_text }}</span>
                                        <span class="mx-3">→</span>
                                        <select name="matching_{{ $question->id }}_{{ $pair->pair_order }}"
                                                class="matching-dropdown"
                                                onchange="saveMatchingAnswer('{{ $testAttempt->attempt_token }}', {{ $question->id }})">
                                            <option value="">Select...</option>
                                            @foreach($question->shuffled_column_b ?? $question->matchingPairs->pluck('column_b_text', 'column_b_key') as $key => $text)
                                                <option value="{{ $key }}" 
                                                        {{ $existingAnswer && isset($existingAnswer->matching_answers[$pair->pair_order]) && $existingAnswer->matching_answers[$pair->pair_order] == $key ? 'selected' : '' }}>
                                                    {{ $key }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Column B -->
                            <div>
                                <h4 class="font-bold text-gray-900 mb-3">Column B</h4>
                                @foreach($question->shuffled_column_b ?? $question->matchingPairs->pluck('column_b_text', 'column_b_key') as $key => $text)
                                    <div class="mb-3 p-3 bg-gray-50 rounded">
                                        <span class="font-bold text-army-green-700 mr-3">{{ $key }}.</span>
                                        <span>{{ $text }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach

        <!-- Navigation -->
        <div class="bg-white rounded-lg shadow-md p-6 sticky bottom-0">
            <div class="flex items-center justify-between">
                <div class="text-gray-600">
                    <p class="font-medium">Review your answers before proceeding</p>
                    <p class="text-sm">You cannot return to this section after moving forward</p>
                </div>
                <button type="submit"
                        onclick="return confirm('Are you sure you want to move to the next section? You cannot come back to this section.')"
                        class="bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-3 px-8 rounded-lg transition-colors">
                    {{ $testAttempt->current_section_index + 1 < $testAttempt->sectionAttempts->count() ? 'Next Section →' : 'Complete Test' }}
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function saveMatchingAnswer(token, questionId) {
    const matchingAnswers = {};
    document.querySelectorAll(`select[name^="matching_${questionId}_"]`).forEach(select => {
        const pairOrder = select.name.split('_')[2];
        if (select.value) {
            matchingAnswers[pairOrder] = select.value;
        }
    });
    
    if (Object.keys(matchingAnswers).length === 4) {
        saveAnswer(token, questionId, { matching_answers: matchingAnswers });
    }
}

// Prevent accidental page refresh
window.addEventListener('beforeunload', function (e) {
    e.preventDefault();
    e.returnValue = '';
});
</script>
@endpush
@endsection