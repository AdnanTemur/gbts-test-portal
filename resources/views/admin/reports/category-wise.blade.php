@extends('layouts.admin')

@section('title', 'Category-wise Report')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Category-wise Report</h1>
        <p class="text-gray-600 mt-1">Section-wise performance analysis</p>
    </div>

    <div class="mb-6">
        <a href="{{ route('admin.reports.index') }}" class="text-gray-600 hover:text-gray-900">
            ← Back to Reports
        </a>
    </div>

    @if(isset($report))
        <!-- Section Performance -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            @foreach($report['sections'] as $section)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $section['name'] }}</h3>

                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Average Score</span>
                            <span class="text-2xl font-bold text-army-green-700">{{ $section['average_percentage'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-army-green-600 rounded-full h-3" style="width: {{ $section['average_percentage'] }}%">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-3 text-center text-sm">
                        <div class="p-3 bg-gray-50 rounded">
                            <div class="font-bold text-gray-900">{{ $section['total_attempts'] }}</div>
                            <div class="text-gray-600">Attempts</div>
                        </div>
                        <div class="p-3 bg-green-50 rounded">
                            <div class="font-bold text-green-700">{{ $section['total_correct'] }}</div>
                            <div class="text-gray-600">Correct</div>
                        </div>
                        <div class="p-3 bg-blue-50 rounded">
                            <div class="font-bold text-blue-700">{{ $section['total_questions'] }}</div>
                            <div class="text-gray-600">Questions</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Most Missed Questions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Top 10 Most Missed Questions by Section</h2>

            @foreach($report['missed_questions'] as $sectionName => $questions)
                <div class="mb-6 last:mb-0">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 pb-2 border-b">{{ $sectionName }}</h3>

                    @if($questions->count() > 0)
                        <div class="space-y-3">
                            @foreach($questions as $sectionName => $questionList)
                                <h3 class="text-lg font-bold text-gray-900 mb-3 pb-2 border-b">{{ $sectionName }}</h3>
                                <div class="space-y-3">
                                    @foreach($questionList as $loopIndex => $question)
                                        <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <span class="font-bold text-red-700">#{{ $loop->iteration }}</span>

                                                        <span class="text-sm text-gray-900">
                                                            {{ Str::limit($question->question_text, 100) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="text-right ml-4">
                                                    <div class="text-2xl font-bold text-red-600">{{ $question->miss_count }}</div>
                                                    <div class="text-xs text-gray-600">times missed</div>
                                                    <div class="text-sm text-red-700 mt-1">
                                                        {{ number_format($question->miss_percentage, 1) }}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">No data available for this section</p>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4">
            <p class="text-yellow-800">No data available. Please select a test version from the Reports page.</p>
        </div>
    @endif
@endsection