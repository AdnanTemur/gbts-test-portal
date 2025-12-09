@extends('layouts.admin')

@section('title', 'Distribution Preview')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Distribution Preview</h1>
    <p class="text-gray-600 mt-1">{{ $testVersion->title }} - {{ $testVersion->version_code }}</p>
</div>

<div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
    <p class="text-blue-800">
        This preview shows the estimated question overlap when {{ $testVersion->expected_candidates }} candidates take this test.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Questions/Section</div>
        <div class="text-3xl font-bold text-army-green-700">{{ $testVersion->questions_per_section }}</div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Total Sections</div>
        <div class="text-3xl font-bold text-army-green-700">{{ $testVersion->testSections->count() }}</div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Expected Candidates</div>
        <div class="text-3xl font-bold text-army-green-700">{{ $testVersion->expected_candidates }}</div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Overlap Threshold</div>
        <div class="text-3xl font-bold text-army-green-700">{{ $testVersion->overlap_threshold }}%</div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Section-wise Distribution Metrics</h2>
    
    <div class="space-y-6">
        @foreach($metrics as $sectionName => $metric)
            <div class="border-b pb-6 last:border-b-0 last:pb-0">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-gray-900">{{ $sectionName }}</h3>
                    <span class="px-3 py-1 text-sm rounded-full {{ $metric['is_valid'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $metric['is_valid'] ? '✓ Valid' : '✗ Invalid' }}
                    </span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    <div class="p-3 bg-gray-50 rounded">
                        <div class="text-xs text-gray-600">Total Questions</div>
                        <div class="text-xl font-bold">{{ $metric['total_questions'] }}</div>
                    </div>

                    <div class="p-3 bg-gray-50 rounded">
                        <div class="text-xs text-gray-600">Questions Needed</div>
                        <div class="text-xl font-bold">{{ $testVersion->questions_per_section * $testVersion->expected_candidates }}</div>
                    </div>

                    @if(isset($metric['overlap_percentage']))
                        <div class="p-3 {{ $metric['overlap_percentage'] <= $testVersion->overlap_threshold ? 'bg-green-50' : 'bg-red-50' }} rounded">
                            <div class="text-xs text-gray-600">Overlap</div>
                            <div class="text-xl font-bold {{ $metric['overlap_percentage'] <= $testVersion->overlap_threshold ? 'text-green-700' : 'text-red-700' }}">
                                {{ $metric['overlap_percentage'] }}%
                            </div>
                        </div>

                        <div class="p-3 bg-gray-50 rounded">
                            <div class="text-xs text-gray-600">Unique Users</div>
                            <div class="text-xl font-bold">{{ floor($metric['total_questions'] / $testVersion->questions_per_section) }}</div>
                        </div>
                    @else
                        <div class="p-3 bg-green-50 rounded">
                            <div class="text-xs text-gray-600">Overlap</div>
                            <div class="text-xl font-bold text-green-700">0%</div>
                        </div>

                        <div class="p-3 bg-green-50 rounded">
                            <div class="text-xs text-gray-600">Status</div>
                            <div class="text-sm font-bold text-green-700">Perfect</div>
                        </div>
                    @endif
                </div>

                <div class="p-4 {{ $metric['is_valid'] ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }} rounded-lg">
                    <p class="text-sm {{ $metric['is_valid'] ? 'text-green-800' : 'text-red-800' }}">
                        {{ $metric['message'] }}
                    </p>
                    
                    @if(!$metric['is_valid'])
                        <p class="text-sm text-red-600 mt-2">
                            ⚠️ Recommendation: Add more questions to this section or reduce expected candidates.
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Understanding the Metrics</h2>
    
    <div class="space-y-3 text-sm text-gray-700">
        <div class="flex items-start">
            <span class="text-green-600 mr-2">✓</span>
            <p><strong>0% Overlap:</strong> Each candidate gets completely unique questions in this section.</p>
        </div>
        <div class="flex items-start">
            <span class="text-yellow-600 mr-2">⚠</span>
            <p><strong>Low Overlap (1-{{ $testVersion->overlap_threshold }}%):</strong> Minimal question repetition between candidates. Acceptable.</p>
        </div>
        <div class="flex items-start">
            <span class="text-red-600 mr-2">✗</span>
            <p><strong>High Overlap (>{{ $testVersion->overlap_threshold }}%):</strong> Too much question repetition. Add more questions to this section.</p>
        </div>
    </div>
</div>

<div class="flex justify-between mt-6">
    <a href="{{ route('admin.test-versions.show', $testVersion) }}" class="text-gray-600 hover:text-gray-900">
        ← Back to Test Version
    </a>
    <a href="{{ route('admin.test-versions.edit', $testVersion) }}" class="bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-2 px-6 rounded-lg">
        Edit Configuration
    </a>
</div>
@endsection