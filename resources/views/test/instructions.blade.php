@extends('layouts.app')

@section('title', 'Test Instructions - ' . config('app.name', 'GBTS Test Portal'))

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold text-primary-900 mb-6 text-center">
                Test Instructions
            </h1>

            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <p class="text-red-800 font-bold">
                    ⚠️ Please read these instructions carefully before starting the test.
                </p>
            </div>

            <div class="space-y-6 mb-8">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-3">📋 General Instructions</h2>
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        <li>This test consists of <strong>{{ $testAttempt->testVersion->testSections->count() }}
                                sections</strong></li>
                        <li>Each section contains <strong>{{ $testAttempt->testVersion->questions_per_section }}
                                questions</strong></li>
                        <li>You have <strong>{{ $testAttempt->testVersion->section_time_limit }} minutes</strong> to
                            complete each section</li>
                        <li>You must complete sections in the given order</li>
                        <li>Once you move to the next section, you <strong>cannot go back</strong></li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-3">⏱️ Timing</h2>
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        <li>Each section has its own timer</li>
                        <li>The timer will be visible at the top of the screen</li>
                        <li>If time expires, the section will be <strong>automatically submitted</strong></li>
                        <li>You can review your answers <strong>within the current section only</strong></li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-3">❓ Question Types</h2>
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        <li><strong>Multiple Choice (MCQ):</strong> Select one correct answer from 4 options</li>
                        <li><strong>True/False:</strong> Select True or False</li>
                        <li><strong>Matching:</strong> Match 4 items from Column A to Column B (all must be correct for
                            marks)</li>
                        <li>Some questions may include images</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-3">✍️ Answering Questions</h2>
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        <li>Your answers are <strong>automatically saved</strong> as you select them</li>
                        <li>You can change your answer anytime within the current section</li>
                        <li>Review all your answers before clicking "Next Section"</li>
                        <li>Unanswered questions will be marked as incorrect</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-3">🎯 Scoring</h2>
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        <li>Each correct answer earns marks</li>
                        <li>For matching questions, <strong>all 4 pairs must be correct</strong> to earn marks</li>
                        <li>Passing threshold: <strong>{{ $testAttempt->testVersion->pass_threshold }}%</strong></li>
                        <li>Results will be shown immediately after test completion</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-3">⚠️ Important Rules</h2>
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        <li>Do not refresh or close the browser during the test</li>
                        <li>Ensure stable internet connection</li>
                        <li>No external help or materials allowed</li>
                        <li>Complete the test honestly and independently</li>
                    </ul>
                </div>
            </div>

            <div class="bg-primary-50 border border-primary-200 rounded-lg p-6 mb-6">
                <h3 class="font-bold text-primary-900 mb-2 text-center">Section Order</h3>
                <div class="flex justify-center items-center space-x-4 text-sm">
                    @foreach($testAttempt->testVersion->testSections as $index => $section)
                        <div class="text-center">
                            <div
                                class="bg-primary-700 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mb-1">
                                {{ $index + 1 }}
                            </div>
                            <div class="text-gray-700">{{ $section->name }}</div>
                        </div>
                        @if(!$loop->last)
                            <div class="text-primary-600">→</div>
                        @endif
                    @endforeach
                </div>
            </div>

            <form action="{{ route('test.begin', $testAttempt->attempt_token) }}" method="POST">
                @csrf
                <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4 mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" required class="mt-1 mr-3">
                        <span class="text-gray-700">
                            I have read and understood all the instructions. I agree to follow all rules and complete the
                            test honestly.
                        </span>
                    </label>
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="bg-primary-700 hover:bg-primary-800 text-white font-bold py-4 px-12 rounded-lg text-lg transition-colors">
                        I Understand, Start Test
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection