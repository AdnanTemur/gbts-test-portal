@extends('layouts.app')

@section('title', 'Test Start - ' . config('app.name', 'GBTS Test Portal'))

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-primary-900 mb-2">
                    Welcome to the Test
                </h1>
                <p class="text-xl text-gray-600">
                    {{ $testAttempt->testVersion->title }}
                </p>
                <p class="text-sm text-gray-500 mt-1">
                    Version: {{ $testAttempt->testVersion->version_code }}
                </p>
            </div>

            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <p class="text-blue-800 font-medium">
                    Hello, {{ $testAttempt->candidate->name }}!
                </p>
                <p class="text-blue-700 text-sm mt-1">
                    You are about to begin the Test.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-50 p-6 rounded-lg text-center">
                    <div class="text-3xl font-bold text-primary-700 mb-2">
                        {{ $testAttempt->testVersion->testSections->count() }}
                    </div>
                    <div class="text-gray-600">Total Sections</div>
                    <div class="text-sm text-gray-500 mt-2">
                        @foreach($testAttempt->testVersion->testSections as $section)
                            <div>{{ $section->name }}</div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg text-center">
                    <div class="text-3xl font-bold text-primary-700 mb-2">
                        {{ $testAttempt->testVersion->questions_per_section }}
                    </div>
                    <div class="text-gray-600">Questions per Section</div>
                    <div class="text-sm text-gray-500 mt-2">
                        Total:
                        {{ $testAttempt->testVersion->questions_per_section * $testAttempt->testVersion->testSections->count() }}
                        questions
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg text-center">
                    <div class="text-3xl font-bold text-primary-700 mb-2">
                        {{ $testAttempt->testVersion->section_time_limit }}
                    </div>
                    <div class="text-gray-600">Minutes per Section</div>
                    <div class="text-sm text-gray-500 mt-2">
                        Total:
                        {{ $testAttempt->testVersion->section_time_limit * $testAttempt->testVersion->testSections->count() }}
                        minutes
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg text-center">
                    <div class="text-3xl font-bold text-primary-700 mb-2">
                        {{ $testAttempt->testVersion->pass_threshold }}%
                    </div>
                    <div class="text-gray-600">Passing Threshold</div>
                    <div class="text-sm text-gray-500 mt-2">
                        Required to pass the test
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('test.instructions', $testAttempt->attempt_token) }}"
                    class="inline-block bg-primary-700 hover:bg-primary-800 text-white font-bold py-4 px-12 rounded-lg text-lg transition-colors">
                    Continue to Instructions →
                </a>
            </div>
        </div>
    </div>
@endsection