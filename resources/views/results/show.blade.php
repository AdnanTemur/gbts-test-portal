@extends('layouts.app')

@section('title', 'Test Results - ' . config('app.name', 'GBTS Test Portal'))

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Result Header -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Test Results</h1>
            <p class="text-xl text-gray-600">{{ $testAttempt->testVersion->title }}</p>
            <p class="text-sm text-gray-500">Version: {{ $testAttempt->testVersion->version_code }}</p>
        </div>

        <!-- Candidate Info -->
        <div class="flex items-center justify-center mb-6">
            @if($testAttempt->candidate->photo)
                <img src="{{ Storage::url($testAttempt->candidate->photo) }}" 
                     alt="{{ $testAttempt->candidate->name }}"
                     class="w-24 h-24 rounded-full object-cover border-4 border-primary-600 mr-6">
            @endif
            <div class="text-left">
                <h2 class="text-2xl font-bold text-gray-900">{{ $testAttempt->candidate->name }}</h2>
                <p class="text-gray-600">S/O {{ $testAttempt->candidate->father_name }}</p>
                <p class="text-sm text-gray-500">CNIC: {{ $testAttempt->candidate->cnic }}</p>
            </div>
        </div>

        <!-- Pass/Fail Badge -->
        <div class="text-center mb-6">
            @if($testAttempt->passed)
                <div class="inline-block bg-green-100 border-2 border-green-500 rounded-full px-8 py-3">
                    <span class="text-3xl font-bold text-green-700">✓ PASSED</span>
                </div>
            @else
                <div class="inline-block bg-red-100 border-2 border-red-500 rounded-full px-8 py-3">
                    <span class="text-3xl font-bold text-red-700">✗ NOT PASSED</span>
                </div>
            @endif
        </div>

        <!-- Score Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-4xl font-bold {{ $testAttempt->percentage >= 80 ? 'text-green-600' : ($testAttempt->percentage >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                    {{ $testAttempt->percentage }}%
                </div>
                <div class="text-sm text-gray-600 mt-1">Overall Score</div>
            </div>
            
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <div class="text-4xl font-bold text-green-600">{{ $testAttempt->correct_answers }}</div>
                <div class="text-sm text-gray-600 mt-1">Correct</div>
            </div>
            
            <div class="text-center p-4 bg-red-50 rounded-lg">
                <div class="text-4xl font-bold text-red-600">{{ $testAttempt->incorrect_answers }}</div>
                <div class="text-sm text-gray-600 mt-1">Incorrect</div>
            </div>
            
            <div class="text-center p-4 bg-gray-100 rounded-lg">
                <div class="text-4xl font-bold text-gray-600">{{ $testAttempt->unanswered }}</div>
                <div class="text-sm text-gray-600 mt-1">Unanswered</div>
            </div>
        </div>

        <!-- Test Info -->
        <div class="mt-6 grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
            <div class="text-center p-3 bg-gray-50 rounded">
                <div class="font-semibold text-gray-900">{{ $testAttempt->total_questions }}</div>
                <div class="text-gray-600">Total Questions</div>
            </div>
            <div class="text-center p-3 bg-gray-50 rounded">
                <div class="font-semibold text-gray-900">{{ gmdate('H:i:s', $testAttempt->time_taken) }}</div>
                <div class="text-gray-600">Time Taken</div>
            </div>
            <div class="text-center p-3 bg-gray-50 rounded">
                <div class="font-semibold text-gray-900">{{ $testAttempt->completed_at->format('M d, Y H:i A') }}</div>
                <div class="text-gray-600">Completed At</div>
            </div>
        </div>
    </div>

    <!-- Section-wise Performance -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Section-wise Performance</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($sectionStats as $stat)
                <div class="border-2 border-gray-200 rounded-lg p-6">
                    <h3 class="font-bold text-lg text-gray-900 mb-4">{{ $stat['name'] }}</h3>
                    
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-gray-600">Score</span>
                        <span class="text-2xl font-bold {{ $stat['percentage'] >= 80 ? 'text-green-600' : ($stat['percentage'] >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $stat['percentage'] }}%
                        </span>
                    </div>
                    
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                        <div class="h-3 rounded-full {{ $stat['percentage'] >= 80 ? 'bg-green-600' : ($stat['percentage'] >= 60 ? 'bg-yellow-600' : 'bg-red-600') }}"
                             style="width: {{ $stat['percentage'] }}%"></div>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-2 text-center text-sm">
                        <div>
                            <div class="font-bold text-green-600">{{ $stat['correct'] }}</div>
                            <div class="text-gray-600">Correct</div>
                        </div>
                        <div>
                            <div class="font-bold text-red-600">{{ $stat['incorrect'] }}</div>
                            <div class="text-gray-600">Incorrect</div>
                        </div>
                        <div>
                            <div class="font-bold text-gray-600">{{ $stat['unanswered'] }}</div>
                            <div class="text-gray-600">Unanswered</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Detailed Answers -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Detailed Answers</h2>
        
        @foreach($testAttempt->candidateAnswers as $index => $answer)
            @php
                $question = $answer->question;
                $correctOption = $question->correctOption;
            @endphp

            <div class="mb-6 pb-6 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                <div class="flex items-start mb-3">
                    <span class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center mr-4 {{ $answer->is_correct ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $answer->is_correct ? '✓' : '✗' }}
                    </span>
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <span class="font-bold text-gray-900 mr-2">Q{{ $index + 1 }}.</span>
                                <span class="text-gray-900">{{ $question->question_text }}</span>
                                <span class="ml-2 text-xs px-2 py-1 rounded {{ $answer->is_correct ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $question->testSection->name }}
                                </span>
                            </div>
                        </div>

                        <!-- MCQ/True-False Answers -->
                        @if($question->isMCQ() || $question->isTrueFalse())
                            <div class="mt-4 space-y-2">
                                @foreach($question->options as $option)
                                    <div class="flex items-center p-3 rounded {{ $option->is_correct ? 'bg-green-50 border border-green-200' : ($answer->selected_option_id == $option->id && !$option->is_correct ? 'bg-red-50 border border-red-200' : 'bg-gray-50') }}">
                                        @if($option->is_correct)
                                            <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @elseif($answer->selected_option_id == $option->id)
                                            <svg class="w-5 h-5 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        @else
                                            <span class="w-5 h-5 mr-2"></span>
                                        @endif
                                        
                                        <span class="{{ $option->is_correct ? 'font-semibold text-green-900' : ($answer->selected_option_id == $option->id ? 'font-semibold text-red-900' : 'text-gray-700') }}">
                                            {{ $option->option_text }}
                                        </span>
                                        
                                        @if($option->is_correct)
                                            <span class="ml-auto text-xs text-green-600 font-semibold">Correct Answer</span>
                                        @elseif($answer->selected_option_id == $option->id)
                                            <span class="ml-auto text-xs text-red-600 font-semibold">Your Answer</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Matching Answers -->
                        @if($question->isMatching())
                            <div class="mt-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-2">Your Answers</h4>
                                        @foreach($question->matchingPairs as $pair)
                                            @php
                                                $yourAnswer = $answer->matching_answers[$pair->pair_order] ?? null;
                                                $isCorrect = $yourAnswer == $pair->column_b_key;
                                            @endphp
                                            <div class="flex items-center mb-2 p-2 rounded {{ $isCorrect ? 'bg-green-50' : 'bg-red-50' }}">
                                                <span class="font-bold mr-2">{{ $pair->pair_order }}.</span>
                                                <span class="mr-2">{{ $pair->column_a_text }}</span>
                                                <span class="mx-2">→</span>
                                                <span class="font-semibold {{ $isCorrect ? 'text-green-700' : 'text-red-700' }}">
                                                    {{ $yourAnswer ?? 'Not answered' }}
                                                </span>
                                                <span class="ml-auto">
                                                    {{ $isCorrect ? '✓' : '✗' }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-2">Correct Answers</h4>
                                        @foreach($question->matchingPairs as $pair)
                                            <div class="flex items-center mb-2 p-2 bg-green-50 rounded">
                                                <span class="font-bold mr-2">{{ $pair->pair_order }}.</span>
                                                <span class="mr-2">{{ $pair->column_a_text }}</span>
                                                <span class="mx-2">→</span>
                                                <span class="font-semibold text-green-700">{{ $pair->column_b_key }}. {{ $pair->column_b_text }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-center space-x-4 mb-8">
        <a href="{{ route('results.pdf', $testAttempt->attempt_token) }}"
           class="bg-rose-600 hover:bg-rose-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            📄 Download PDF Certificate
        </a>
        <a href="{{ route('results.pdf.answersheet', $testAttempt->attempt_token) }}"
           class="bg-teal-700 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            📄 Download Answer Sheet
        </a>
        <button onclick="window.print()" 
                class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            🖨️ Print Results
        </button>
        <a href="{{ route('home') }}"
           class="bg-primary-700 hover:bg-primary-800 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            ← Back to Home
        </a>
    </div>
</div>
@endsection