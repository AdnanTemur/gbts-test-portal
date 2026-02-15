@extends('layouts.admin')

@section('title', 'View Test Version')

@section('content')
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-primary-700">{{ $testVersion->title }}</h1>
                <p class="text-sm text-gray-600 mt-1">{{ $testVersion->version_code }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.test-versions.preview', $testVersion) }}" 
                   class="inline-flex items-center px-4 py-1 bg-teal-800 hover:bg-teal-900 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Preview Distribution
                </a>
                <a href="{{ route('admin.test-versions.edit', $testVersion) }}" 
                   class="inline-flex items-center px-4 py-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('admin.test-versions.index') }}" 
                   class="inline-flex items-center px-4 py-1 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </div>

    <!-- Status Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="p-3 bg-blue-50 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Status</p>
                    @php
                        $statusConfig = [
                            'active' => ['color' => 'bg-green-100 text-green-800', 'dot' => 'bg-green-500'],
                            'draft' => ['color' => 'bg-yellow-100 text-yellow-800', 'dot' => 'bg-yellow-500'],
                            'archived' => ['color' => 'bg-gray-100 text-gray-800', 'dot' => 'bg-gray-500'],
                        ];
                        $status = $statusConfig[$testVersion->status] ?? $statusConfig['draft'];
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $status['color'] }}">
                        <svg class="w-2 h-2 mr-1.5 {{ $status['dot'] }}" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3"/>
                        </svg>
                        {{ ucfirst($testVersion->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="p-3 bg-primary-50 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Attempts</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $testVersion->testAttempts()->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="p-3 bg-blue-50 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Completed</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $testVersion->completedAttempts()->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Configuration Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Test Configuration</h2>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
                <div class="p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg border border-blue-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-xs text-blue-700 mb-1">Time/Section</div>
                    <div class="text-2xl font-bold text-blue-900">{{ $testVersion->section_time_limit }} <span class="text-sm">min</span></div>
                </div>

                <div class="p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg border border-purple-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-xs text-purple-700 mb-1">Questions/Section</div>
                    <div class="text-2xl font-bold text-purple-900">{{ $testVersion->questions_per_section }}</div>
                </div>

                <div class="p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-lg border border-green-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-xs text-green-700 mb-1">Pass Threshold</div>
                    <div class="text-2xl font-bold text-green-900">{{ $testVersion->pass_threshold }}<span class="text-sm">%</span></div>
                </div>

                <div class="p-4 bg-gradient-to-br from-amber-50 to-amber-100 rounded-lg border border-amber-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-amber-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="text-xs text-amber-700 mb-1">Overlap Threshold</div>
                    <div class="text-2xl font-bold text-amber-900">{{ $testVersion->overlap_threshold }}<span class="text-sm">%</span></div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="text-gray-600">Expected Candidates:</span>
                        <span class="font-semibold text-gray-900 ml-2">{{ $testVersion->expected_candidates }}</span>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                        <span class="text-gray-600">Shuffle Questions:</span>
                        <span class="font-semibold text-gray-900 ml-2">{{ $testVersion->shuffle_questions ? 'Yes' : 'No' }}</span>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                        <span class="text-gray-600">Shuffle Options:</span>
                        <span class="font-semibold text-gray-900 ml-2">{{ $testVersion->shuffle_options ? 'Yes' : 'No' }}</span>
                    </div>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-gray-600">Created:</span>
                        <span class="font-semibold text-gray-900 ml-2">{{ $testVersion->created_at->format('M d, Y H:i A') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Order Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Test Sections</h2>
        </div>

        <div class="p-6">
            <div class="space-y-3">
                @foreach($testVersion->testSections as $index => $section)
                    <div class="flex items-center p-4 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-gray-200 hover:border-primary-300 transition-colors">
                        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary-700 to-primary-600 text-white rounded-lg flex items-center justify-center font-bold shadow-sm mr-4">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-900">{{ $section->name }}</div>
                            <div class="text-sm text-gray-600 flex items-center mt-0.5">
                                <svg class="w-3 h-3 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $section->activeQuestions()->count() }} questions available
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Distribution Metrics Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Distribution Metrics</h2>
        </div>

        <div class="p-6">
            @if(count($metrics) > 0)
                <div class="space-y-4">
                    @foreach($metrics as $sectionName => $metric)
                        <div class="p-4 rounded-lg border-2 {{ $metric['is_valid'] ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }}">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center">
                                    @if($metric['is_valid'])
                                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    @endif
                                    <h3 class="font-bold text-gray-900">{{ $sectionName }}</h3>
                                </div>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $metric['is_valid'] ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                    {{ $metric['message'] }}
                                </span>
                            </div>

                            @if(isset($metric['overlap_percentage']))
                                <div class="flex items-center gap-6 text-sm">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                        </svg>
                                        <span class="text-gray-600">Overlap:</span>
                                        <span class="font-bold ml-1.5 {{ $metric['overlap_percentage'] <= $testVersion->overlap_threshold ? 'text-green-700' : 'text-red-700' }}">
                                            {{ $metric['overlap_percentage'] }}%
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                        </svg>
                                        <span class="text-gray-600">Total Questions:</span>
                                        <span class="font-bold ml-1.5 text-gray-900">{{ $metric['total_questions'] }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="font-semibold">{{ $metric['total_questions'] }}</span> questions available - Unique sets possible
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="mt-2 text-sm text-gray-500">No sections configured</p>
                </div>
            @endif
        </div>
    </div>
@endsection