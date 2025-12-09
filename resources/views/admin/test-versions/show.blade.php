@extends('layouts.admin')

@section('title', 'View Test Version')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">{{ $testVersion->title }}</h1>
        <p class="text-gray-600 mt-1">{{ $testVersion->version_code }}</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.test-versions.preview', $testVersion) }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">
            📊 Preview Distribution
        </a>
        <a href="{{ route('admin.test-versions.edit', $testVersion) }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg">
            ✏️ Edit
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Status</div>
        <span class="px-3 py-1 text-sm rounded-full 
            {{ $testVersion->status == 'active' ? 'bg-green-100 text-green-800' : 
               ($testVersion->status == 'draft' ? 'bg-yellow-100 text-yellow-800' : 
               'bg-gray-100 text-gray-800') }}">
            {{ ucfirst($testVersion->status) }}
        </span>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Total Attempts</div>
        <div class="text-3xl font-bold text-army-green-700">{{ $testVersion->testAttempts()->count() }}</div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Completed</div>
        <div class="text-3xl font-bold text-blue-600">{{ $testVersion->completedAttempts()->count() }}</div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Configuration</h2>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="p-4 bg-gray-50 rounded-lg">
            <div class="text-sm text-gray-600">Time per Section</div>
            <div class="text-2xl font-bold text-army-green-700">{{ $testVersion->section_time_limit }} min</div>
        </div>

        <div class="p-4 bg-gray-50 rounded-lg">
            <div class="text-sm text-gray-600">Questions/Section</div>
            <div class="text-2xl font-bold text-army-green-700">{{ $testVersion->questions_per_section }}</div>
        </div>

        <div class="p-4 bg-gray-50 rounded-lg">
            <div class="text-sm text-gray-600">Pass Threshold</div>
            <div class="text-2xl font-bold text-army-green-700">{{ $testVersion->pass_threshold }}%</div>
        </div>

        <div class="p-4 bg-gray-50 rounded-lg">
            <div class="text-sm text-gray-600">Overlap Threshold</div>
            <div class="text-2xl font-bold text-army-green-700">{{ $testVersion->overlap_threshold }}%</div>
        </div>
    </div>

    <div class="mt-4 pt-4 border-t">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-600">Expected Candidates:</span>
                <span class="font-semibold ml-2">{{ $testVersion->expected_candidates }}</span>
            </div>
            <div>
                <span class="text-gray-600">Shuffle Questions:</span>
                <span class="font-semibold ml-2">{{ $testVersion->shuffle_questions ? 'Yes' : 'No' }}</span>
            </div>
            <div>
                <span class="text-gray-600">Shuffle Options:</span>
                <span class="font-semibold ml-2">{{ $testVersion->shuffle_options ? 'Yes' : 'No' }}</span>
            </div>
            <div>
                <span class="text-gray-600">Created:</span>
                <span class="font-semibold ml-2">{{ $testVersion->created_at->format('M d, Y H:i A') }}</span>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Section Order</h2>
    
    <div class="space-y-2">
        @foreach($testVersion->testSections as $index => $section)
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <div class="w-10 h-10 bg-army-green-700 text-white rounded-full flex items-center justify-center font-bold mr-4">
                    {{ $index + 1 }}
                </div>
                <div class="flex-1">
                    <div class="font-semibold text-gray-900">{{ $section->name }}</div>
                    <div class="text-sm text-gray-600">{{ $section->activeQuestions()->count() }} questions available</div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Distribution Metrics</h2>
    
    @if(count($metrics) > 0)
        <div class="space-y-4">
            @foreach($metrics as $sectionName => $metric)
                <div class="p-4 border rounded-lg {{ $metric['is_valid'] ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }}">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-bold text-gray-900">{{ $sectionName }}</h3>
                        <span class="text-sm {{ $metric['is_valid'] ? 'text-green-700' : 'text-red-700' }}">
                            {{ $metric['message'] }}
                        </span>
                    </div>
                    
                    @if(isset($metric['overlap_percentage']))
                        <div class="flex items-center gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Overlap:</span>
                                <span class="font-bold {{ $metric['overlap_percentage'] <= $testVersion->overlap_threshold ? 'text-green-700' : 'text-red-700' }}">
                                    {{ $metric['overlap_percentage'] }}%
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-600">Total Questions:</span>
                                <span class="font-bold">{{ $metric['total_questions'] }}</span>
                            </div>
                        </div>
                    @else
                        <div class="text-sm text-gray-600">
                            {{ $metric['total_questions'] }} questions available - Unique sets possible
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">No sections configured</p>
    @endif
</div>
@endsection