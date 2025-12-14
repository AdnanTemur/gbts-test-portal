@extends('layouts.admin')

@section('title', 'Distribution Preview')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-army-green-700">Distribution Preview</h1>
            <p class="text-gray-600 mt-1">{{ $testVersion->title }} - {{ $testVersion->version_code }}</p>
        </div>

        <!-- Info Banner -->
        <div class="bg-blue-50 border-l-4 border-blue-400 rounded-r-lg p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-800">
                        This preview shows the estimated question overlap when
                        <strong>{{ $testVersion->expected_candidates }} candidates</strong> take this test.
                    </p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Questions/Section</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $testVersion->questions_per_section }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Sections</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $testVersion->testSections->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center">
                    <div class="p-3 bg-green-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Expected Candidates</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $testVersion->expected_candidates }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center">
                    <div class="p-3 bg-amber-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Overlap Threshold</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $testVersion->overlap_threshold }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Metrics -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Section-wise Distribution Metrics</h2>
            </div>

            <div class="p-6">
                <div class="space-y-6">
                    @foreach($metrics as $sectionName => $metric)
                        <div
                            class="border-2 {{ $metric['is_valid'] ? 'border-green-200' : 'border-red-200' }} rounded-lg p-5 {{ $metric['is_valid'] ? 'bg-green-50' : 'bg-red-50' }}">
                            <!-- Section Header -->
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center">
                                    @if($metric['is_valid'])
                                        <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                    <h3 class="text-lg font-bold text-gray-900">{{ $sectionName }}</h3>
                                </div>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $metric['is_valid'] ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                    {{ $metric['is_valid'] ? '✓ Valid' : '✗ Invalid' }}
                                </span>
                            </div>

                            <!-- Metrics Grid -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                                <div class="p-3 bg-white rounded-lg border border-gray-200">
                                    <div class="text-xs text-gray-600 mb-1">Total Questions</div>
                                    <div class="text-xl font-bold text-gray-900">{{ $metric['total_questions'] }}</div>
                                </div>

                                <div class="p-3 bg-white rounded-lg border border-gray-200">
                                    <div class="text-xs text-gray-600 mb-1">Questions Needed</div>
                                    <div class="text-xl font-bold text-gray-900">
                                        {{ $testVersion->questions_per_section * $testVersion->expected_candidates }}</div>
                                </div>

                                @if(isset($metric['overlap_percentage']))
                                    <div
                                        class="p-3 bg-white rounded-lg border-2 {{ $metric['overlap_percentage'] <= $testVersion->overlap_threshold ? 'border-green-400' : 'border-red-400' }}">
                                        <div class="text-xs text-gray-600 mb-1">Overlap</div>
                                        <div
                                            class="text-xl font-bold {{ $metric['overlap_percentage'] <= $testVersion->overlap_threshold ? 'text-green-700' : 'text-red-700' }}">
                                            {{ $metric['overlap_percentage'] }}%
                                        </div>
                                    </div>

                                    <div class="p-3 bg-white rounded-lg border border-gray-200">
                                        <div class="text-xs text-gray-600 mb-1">Unique Users</div>
                                        <div class="text-xl font-bold text-gray-900">
                                            {{ floor($metric['total_questions'] / $testVersion->questions_per_section) }}</div>
                                    </div>
                                @else
                                    <div class="p-3 bg-white rounded-lg border-2 border-green-400">
                                        <div class="text-xs text-gray-600 mb-1">Overlap</div>
                                        <div class="text-xl font-bold text-green-700">0%</div>
                                    </div>

                                    <div class="p-3 bg-white rounded-lg border border-gray-200">
                                        <div class="text-xs text-gray-600 mb-1">Status</div>
                                        <div class="text-sm font-bold text-green-700">Perfect</div>
                                    </div>
                                @endif
                            </div>

                            <!-- Message Box -->
                            <div
                                class="p-4 bg-white rounded-lg border-l-4 {{ $metric['is_valid'] ? 'border-green-500' : 'border-red-500' }}">
                                <p class="text-sm font-medium {{ $metric['is_valid'] ? 'text-green-800' : 'text-red-800' }}">
                                    {{ $metric['message'] }}
                                </p>

                                @if(!$metric['is_valid'])
                                    <div class="mt-3 flex items-start">
                                        <svg class="w-5 h-5 text-amber-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <p class="text-sm text-red-700">
                                            <strong>Recommendation:</strong> Add more questions to this section or reduce expected
                                            candidates.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Understanding Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Understanding the Metrics</h2>
            </div>

            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-start p-4 bg-green-50 rounded-lg border border-green-200">
                        <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-green-900 mb-1">0% Overlap</p>
                            <p class="text-sm text-green-700">Each candidate gets completely unique questions in this
                                section.</p>
                        </div>
                    </div>

                    <div class="flex items-start p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <svg class="w-6 h-6 text-yellow-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-yellow-900 mb-1">Low Overlap
                                (1-{{ $testVersion->overlap_threshold }}%)</p>
                            <p class="text-sm text-yellow-700">Minimal question repetition between candidates. Acceptable
                                range.</p>
                        </div>
                    </div>

                    <div class="flex items-start p-4 bg-red-50 rounded-lg border border-red-200">
                        <svg class="w-6 h-6 text-red-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-sm font-semibold text-red-900 mb-1">High Overlap
                                (>{{ $testVersion->overlap_threshold }}%)</p>
                            <p class="text-sm text-red-700">Too much question repetition. Add more questions to this
                                section.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between">
            <a href="{{ route('admin.test-versions.show', $testVersion) }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Test Version
            </a>
            <a href="{{ route('admin.test-versions.edit', $testVersion) }}"
                class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-army-green-700 to-army-green-600 hover:from-army-green-800 hover:to-army-green-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit Configuration
            </a>
        </div>
    </div>
@endsection