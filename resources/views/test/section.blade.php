@extends('layouts.app')

@section('title', 'Test Section - ' . config('app.name', 'GBTS Test Portal'))

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8" x-data="testSection()">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Card with Timer and Progress -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Section Info -->
                    <div class="md:col-span-2">
                        <div class="flex items-center mb-2">
                            <div
                                class="inline-flex items-center px-3 py-1 bg-primary-100 text-primary-800 rounded-full text-sm font-semibold mr-3">
                                Section {{ $currentSection->section_order + 1 }} of
                                {{ $testAttempt->sectionAttempts->count() }}
                            </div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $currentSection->testSection->name }}</h1>
                        </div>

                        <!-- Question Progress -->
                        <div class="mt-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-semibold text-gray-700">Question <span
                                        x-text="currentQuestion + 1"></span> of {{ $questions->count() }}</span>
                                <span class="text-sm text-gray-600"
                                    x-text="Math.round(((currentQuestion + 1) / {{ $questions->count() }}) * 100) + '%'"></span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-primary-600 to-primary-500 h-3 rounded-full transition-all duration-300"
                                    :style="`width: ${((currentQuestion + 1) / {{ $questions->count() }}) * 100}%`"></div>
                            </div>
                        </div>

                        <!-- Question Navigator -->
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($questions as $index => $assignment)
                                <button type="button" @click="currentQuestion = {{ $index }}" :class="{
                                                                        'bg-primary-600 text-white': currentQuestion === {{ $index }},
                                                                        'bg-green-100 text-green-700 border-green-300': currentQuestion !== {{ $index }} && isAnswered({{ $index }}),
                                                                        'bg-white text-gray-700 border-gray-300': currentQuestion !== {{ $index }} && !isAnswered({{ $index }})
                                                                    }"
                                    class="w-10 h-10 rounded-lg border-2 font-semibold text-sm transition-all hover:scale-110">
                                    {{ $index + 1 }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Timer Card -->
                    <div x-data="initSectionTimer('{{ $endTime->toIso8601String() }}')"
                        class="bg-gradient-to-br rounded-xl p-6 text-center"
                        :class="isWarning() ? 'from-red-500 to-red-600' : 'from-primary-600 to-primary-700'">
                        <svg class="w-12 h-12 mx-auto mb-3 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm font-semibold text-white/80 mb-2">Time Remaining</div>
                        <div class="text-4xl font-bold text-white mb-2" x-text="formatTime()"></div>
                        <div class="text-xs text-white/70" :class="isWarning() ? 'animate-pulse' : ''" x-show="isWarning()">
                            ⚠️ Hurry Up!
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question Card -->
            @foreach($questions as $index => $assignment)
                @php
                    $question = $assignment->question;
                    $questionNumber = ($currentSection->section_order * $testAttempt->testVersion->questions_per_section) + $index + 1;
                    $existingAnswer = $existingAnswers->get($question->id);
                @endphp

                <div x-show="currentQuestion === {{ $index }}" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-4"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    class="bg-white rounded-xl shadow-lg border border-gray-200 p-8 mb-6" id="question-{{ $question->id }}">

                    <!-- Question Header -->
                    <div class="flex items-start gap-4 mb-6">
                        <div class="flex-shrink-0">
                            <div
                                class="w-14 h-14 bg-gradient-to-br from-primary-600 to-primary-700 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold text-lg">{{ $index + 1 }}</span>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span
                                    class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                    {{ strtoupper(str_replace('_', ' ', $question->question_type)) }}
                                </span>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                                                {{ $question->difficulty_level === 'easy' ? 'bg-green-100 text-green-800' :
                ($question->difficulty_level === 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($question->difficulty_level) }}
                                </span>
                                @if($question->marks > 1)
                                    <span
                                        class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">
                                        {{ $question->marks }} marks
                                    </span>
                                @endif
                            </div>

                            <p class="text-xl font-medium text-gray-900 leading-relaxed">{{ $question->question_text }}</p>

                            @if($question->question_image)
                                <div class="mt-4">
                                    <img src="{{ Storage::url($question->question_image) }}" alt="Question Image"
                                        class="max-w-2xl rounded-xl border-2 border-gray-300 shadow-md">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Answer Options -->
                    <div class="mt-8">
                        @if($question->isMCQ() || $question->isTrueFalse())
                            <!-- MCQ/True-False Options -->
                            <div class="space-y-3">
                                @foreach($question->options as $optIndex => $option)
                                    <label
                                        class="flex items-start px-4 py-2 border-2 rounded-xl cursor-pointer transition-all hover:shadow-md
                                                                                                    {{ $existingAnswer && $existingAnswer->selected_option_id == $option->id ? 'border-primary-600 bg-primary-50' : 'border-gray-300 hover:border-primary-300' }}"
                                        @click="markAnswered({{ $index }})">
                                        <input type="radio" name="question_{{ $question->id }}" value="{{ $option->id }}" {{ $existingAnswer && $existingAnswer->selected_option_id == $option->id ? 'checked' : '' }}
                                            onchange="saveAnswer('{{ $testAttempt->attempt_token }}', {{ $question->id }}, { selected_option_id: {{ $option->id }} })"
                                            class="mt-1 w-5 h-5 text-primary-600 focus:ring-primary-500">

                                        <div class="ml-4 flex-1">
                                            <span
                                                class="inline-block w-8 h-8 bg-gray-100 rounded-lg text-center leading-8 font-bold text-gray-700 mr-3">
                                                {{ chr(65 + $optIndex) }}
                                            </span>

                                            @if($option->option_image)
                                                <img src="{{ Storage::url($option->option_image) }}" alt="Option {{ chr(65 + $optIndex) }}"
                                                    class="inline-block max-w-md rounded-lg border mt-2">
                                            @else
                                                <span class="text-gray-900">{{ $option->option_text }}</span>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @endif

                        @if($question->isMatching())
                            <!-- Matching Questions -->
                            <div class="bg-gray-50 rounded-xl p-6 border-2 border-gray-200">
                                <p class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Match items from Column A to Column B
                                </p>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Column A -->
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-4 text-lg">Column A</h4>
                                        @foreach($question->matchingPairs->sortBy('pair_order') as $pair)
                                            <div class="flex items-center mb-4 p-4 bg-white rounded-lg border-2 border-gray-300">
                                                <span
                                                    class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-lg flex items-center justify-center font-bold mr-3">
                                                    {{ $pair->pair_order }}
                                                </span>
                                                <span class="flex-1 text-gray-900">{{ $pair->column_a_text }}</span>
                                                <svg class="w-5 h-5 text-gray-400 mx-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                </svg>
                                                <select name="matching_{{ $question->id }}_{{ $pair->pair_order }}"
                                                    @change="markAnswered({{ $index }})"
                                                    class="flex-shrink-0 px-3 py-2 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none font-semibold"
                                                    onchange="saveMatchingAnswer('{{ $testAttempt->attempt_token }}', {{ $question->id }})">
                                                    <option value="">--</option>
                                                    @foreach($question->shuffled_column_b ?? $question->matchingPairs->pluck('column_b_text', 'column_b_key') as $key => $text)
                                                        <option value="{{ $key }}" {{ $existingAnswer && isset($existingAnswer->matching_answers[$pair->pair_order]) && $existingAnswer->matching_answers[$pair->pair_order] == $key ? 'selected' : '' }}>
                                                            {{ $key }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Column B -->
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-4 text-lg">Column B</h4>
                                        @foreach($question->shuffled_column_b ?? $question->matchingPairs->pluck('column_b_text', 'column_b_key') as $key => $text)
                                            <div class="mb-4 px-4 py-5 bg-green-50 rounded-lg border-2 border-green-200">
                                                <span
                                                    class="inline-block w-8 h-8 bg-green-600 text-white rounded-lg text-center leading-8 font-bold mr-3">
                                                    {{ $key }}
                                                </span>
                                                <span class="text-gray-900">{{ $text }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            <!-- Navigation Buttons -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 sticky bottom-4">
                <div class="flex items-center justify-between">
                    <button type="button" @click="previousQuestion()" x-show="currentQuestion > 0"
                        class="inline-flex items-center px-6 py-2 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Previous
                    </button>

                    <div class="text-center" x-show="currentQuestion < {{ $questions->count() - 1 }}">
                        <p class="text-sm text-gray-600">Question <span x-text="currentQuestion + 1"></span> of
                            {{ $questions->count() }}
                        </p>
                    </div>

                    <button type="button" @click="nextQuestion()" x-show="currentQuestion < {{ $questions->count() - 1 }}"
                        class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-primary-700 to-primary-600 hover:from-primary-800 hover:to-primary-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all">
                        Next
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <form id="section-form" x-show="currentQuestion === {{ $questions->count() - 1 }}" method="POST"
                        action="{{ route('test.nextSection', $testAttempt->attempt_token) }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-8 py-2 bg-gradient-to-r from-primary-700 to-primary-600 hover:from-primary-700 hover:to-primary-800 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all">
                            {{ $testAttempt->current_section_index + 1 < $testAttempt->sectionAttempts->count() ? 'Next Section' : 'Complete Test' }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function testSection() {
                return {
                    currentQuestion: 0,
                    answeredQuestions: new Set(@json($existingAnswers->keys()->toArray())),

                    nextQuestion() {
                        if (this.currentQuestion < {{ $questions->count() - 1 }}) {
                            this.currentQuestion++;
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        }
                    },

                    previousQuestion() {
                        if (this.currentQuestion > 0) {
                            this.currentQuestion--;
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        }
                    },

                    markAnswered(index) {
                        const questionId = {{ $questions->pluck('question.id')->toJson() }}[index];
                        this.answeredQuestions.add(questionId);
                    },

                    isAnswered(index) {
                        const questionId = {{ $questions->pluck('question.id')->toJson() }}[index];
                        return this.answeredQuestions.has(questionId);
                    }
                }
            }

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

            // Keyboard navigation
            document.addEventListener('keydown', function (e) {
                if (e.key === 'ArrowLeft') {
                    Alpine.store('testSection')?.previousQuestion?.();
                } else if (e.key === 'ArrowRight') {
                    Alpine.store('testSection')?.nextQuestion?.();
                }
            });

            document.addEventListener('DOMContentLoaded', function () {
                const sectionForm = document.getElementById('section-form');
                const manualSubmitButton = sectionForm?.querySelector('button[type="submit"]');

                if (sectionForm && manualSubmitButton) {
                    // Intercept manual submission
                    manualSubmitButton.addEventListener('click', function (e) {
                        if (!confirm('Are you sure you want to move to the next section? You cannot come back to this section.')) {
                            e.preventDefault();
                        }
                    });
                }
            });

        </script>
    @endpush
@endsection