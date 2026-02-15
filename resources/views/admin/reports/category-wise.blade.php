@extends('layouts.admin')

@section('title', 'Category-wise Report')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-primary-700">Category-wise Report</h1>
                    <p class="text-gray-600 mt-1">Section-wise performance analysis and insights</p>
                </div>
                <a href="{{ route('admin.reports.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Reports
                </a>
            </div>
        </div>

        @if(isset($report) && !empty($report['sections']))
            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Section Performance Comparison -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Section Performance Comparison</h3>
                    <div id="sectionPerformanceChart"></div>
                </div>

                <!-- Section Distribution -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Attempt Distribution</h3>
                    <div id="sectionDistributionChart"></div>
                </div>

                <!-- Accuracy Radar -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Section Accuracy Overview</h3>
                    <div id="accuracyRadarChart"></div>
                </div>

                <!-- Correct vs Total Questions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Correct Answers vs Total Questions</h3>
                    <div id="correctVsTotalChart"></div>
                </div>
            </div>

            <!-- Section Performance Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                @php
                    $colors = [
                        ['from' => 'from-primary-700', 'to' => 'to-primary-600', 'bg' => 'bg-primary-50', 'text' => 'text-primary-700', 'bar' => 'bg-primary-600', 'border' => 'border-primary-200'],
                        ['from' => 'from-teal-700', 'to' => 'to-teal-600', 'bg' => 'bg-teal-50', 'text' => 'text-teal-700', 'bar' => 'bg-teal-600', 'border' => 'border-teal-200'],
                        ['from' => 'from-emerald-700', 'to' => 'to-emerald-600', 'bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'bar' => 'bg-emerald-600', 'border' => 'border-emerald-200'],
                        ['from' => 'from-cyan-700', 'to' => 'to-cyan-600', 'bg' => 'bg-cyan-50', 'text' => 'text-cyan-700', 'bar' => 'bg-cyan-600', 'border' => 'border-cyan-200'],
                        ['from' => 'from-slate-700', 'to' => 'to-slate-600', 'bg' => 'bg-slate-50', 'text' => 'text-slate-700', 'bar' => 'bg-slate-600', 'border' => 'border-slate-200'],
                        ['from' => 'from-gray-700', 'to' => 'to-gray-600', 'bg' => 'bg-gray-50', 'text' => 'text-gray-700', 'bar' => 'bg-gray-600', 'border' => 'border-gray-200'],
                    ];
                    $colorIndex = 0;
                @endphp

                @foreach($report['sections'] as $section)
                    @php
                        $color = $colors[$colorIndex % count($colors)];
                        $colorIndex++;
                    @endphp
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <!-- Card Header -->
                        <div class="px-5 py-3 bg-gradient-to-r {{ $color['from'] }} {{ $color['to'] }}">
                            <h3 class="text-base font-bold text-white">{{ $section['name'] }}</h3>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5">
                            <!-- Average Score -->
                            <div class="mb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-semibold text-gray-700">Average Score</span>
                                    <span
                                        class="text-2xl font-bold {{ $color['text'] }}">{{ $section['average_percentage'] }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="{{ $color['bar'] }} rounded-full h-2 transition-all duration-500"
                                        style="width: {{ $section['average_percentage'] }}%"></div>
                                </div>
                            </div>

                            <!-- Stats Grid -->
                            <div class="grid grid-cols-3 gap-3 text-center text-sm">
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <div class="text-xl font-bold text-gray-900">{{ $section['total_attempts'] }}</div>
                                    <div class="text-xs text-gray-600 mt-1">Attempts</div>
                                </div>
                                <div class="p-3 {{ $color['bg'] }} rounded-lg border {{ $color['border'] }}">
                                    <div class="text-xl font-bold {{ $color['text'] }}">{{ $section['total_correct'] }}</div>
                                    <div class="text-xs text-gray-600 mt-1">Correct</div>
                                </div>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <div class="text-xl font-bold text-gray-900">{{ $section['total_questions'] }}</div>
                                    <div class="text-xs text-gray-600 mt-1">Questions</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Most Missed Questions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Top 10 Most Missed Questions by Section</h2>
                </div>

                <div class="p-6">
                    @foreach($report['missed_questions'] as $sectionName => $questions)
                        <div class="mb-8 last:mb-0">
                            <div class="flex items-center mb-4">
                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="text-lg font-bold text-gray-900">{{ $sectionName }}</h3>
                            </div>

                            @if(is_object($questions) && method_exists($questions, 'count') && $questions->count() > 0)
                                <div class="space-y-3">
                                    @foreach($questions as $question)
                                        <div
                                            class="p-4 bg-red-50 border-l-4 border-red-400 rounded-r-lg hover:bg-red-100 transition-colors">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <div class="flex items-start gap-3 mb-2">
                                                        <span
                                                            class="flex-shrink-0 inline-flex items-center justify-center w-8 h-8 bg-red-600 text-white text-sm font-bold rounded-full">
                                                            {{ $loop->iteration }}
                                                        </span>
                                                        <div class="flex-1">
                                                            <p class="text-sm text-gray-900 leading-relaxed">
                                                                {{ Str::limit($question->question_text ?? 'N/A', 150) }}
                                                            </p>
                                                            @if(isset($question->question_type) || isset($question->difficulty_level))
                                                                <div class="flex items-center gap-3 mt-2">
                                                                    @if(isset($question->question_type))
                                                                        <span
                                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-200 text-gray-800">
                                                                            {{ ucfirst($question->question_type) }}
                                                                        </span>
                                                                    @endif
                                                                    @if(isset($question->difficulty_level))
                                                                                        <span
                                                                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                                                                                                                                                {{ $question->difficulty_level == 'hard' ? 'bg-red-200 text-red-800' :
                                                                        ($question->difficulty_level == 'medium' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800') }}">
                                                                                            {{ ucfirst($question->difficulty_level) }}
                                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right ml-4 flex-shrink-0">
                                                    <div class="text-3xl font-bold text-red-600">{{ $question->miss_count ?? 0 }}</div>
                                                    <div class="text-xs text-gray-600">times missed</div>
                                                    <div class="mt-2 px-2 py-1 bg-red-200 text-red-800 text-sm font-bold rounded">
                                                        {{ number_format($question->miss_percentage ?? 0, 1) }}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="p-8 text-center bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">No missed questions data for this section</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-800 font-medium">No data available. Please select a test version from the
                            Reports page.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if(isset($report) && !empty($report['sections']))
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Convert sections object to array
                    const sectionsData = @json(array_values($report['sections']));

                    const sectionNames = sectionsData.map(s => s.name);
                    const averageScores = sectionsData.map(s => parseFloat(s.average_percentage));
                    const totalAttempts = sectionsData.map(s => parseInt(s.total_attempts));
                    const totalCorrect = sectionsData.map(s => parseInt(s.total_correct));
                    const totalQuestions = sectionsData.map(s => parseInt(s.total_questions));

                    // 1. Section Performance Bar Chart
                    const sectionPerformanceChart = new ApexCharts(document.querySelector("#sectionPerformanceChart"), {
                        series: [{ name: 'Average Score', data: averageScores }],
                        chart: { type: 'bar', height: 350, toolbar: { show: false } },
                        colors: ['#15803d'],
                        plotOptions: {
                            bar: { borderRadius: 8, dataLabels: { position: 'top' }, columnWidth: '60%' }
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: val => val.toFixed(1) + "%",
                            offsetY: -20,
                            style: { fontSize: '12px', colors: ["#304758"] }
                        },
                        xaxis: {
                            categories: sectionNames, labels: {
                                hideOverlappingLabels: false
                            }
                        },
                        yaxis: { min: 0, max: 100, title: { text: 'Average Score (%)' } },
                        grid: { borderColor: '#f1f1f1' }
                    });
                    sectionPerformanceChart.render();

                    // 2. Section Distribution Donut Chart
                    const sectionDistributionChart = new ApexCharts(document.querySelector("#sectionDistributionChart"), {
                        series: totalAttempts,
                        chart: { type: 'donut', height: 350 },
                        labels: sectionNames,
                        colors: ['#3b82f6', '#8b5cf6', '#10b981', '#f59e0b', '#ef4444', '#6366f1'],
                        legend: { position: 'bottom' },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '70%',
                                    labels: {
                                        show: true,
                                        total: {
                                            show: true,
                                            label: 'Total Attempts',
                                            formatter: w => w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                        }
                                    }
                                }
                            }
                        }
                    });
                    sectionDistributionChart.render();

                    // 3. Accuracy Radar Chart
                    const accuracyRadarChart = new ApexCharts(document.querySelector("#accuracyRadarChart"), {
                        series: [{ name: 'Accuracy', data: averageScores }],
                        chart: { type: 'radar', height: 350, toolbar: { show: false } },
                        colors: ['#15803d'],
                        xaxis: { categories: sectionNames },
                        yaxis: { min: 0, max: 100, tickAmount: 5 },
                        fill: { opacity: 0.2 },
                        markers: { size: 5 },
                        tooltip: { y: { formatter: val => val.toFixed(1) + '%' } }
                    });
                    accuracyRadarChart.render();

                    // 4. Correct vs Total Questions Grouped Bar Chart
                    const correctVsTotalChart = new ApexCharts(document.querySelector("#correctVsTotalChart"), {
                        series: [
                            { name: 'Correct Answers', data: totalCorrect },
                            { name: 'Total Questions', data: totalQuestions }
                        ],
                        chart: { type: 'bar', height: 350, toolbar: { show: false } },
                        colors: ['#10b981', '#3b82f6'],
                        plotOptions: { bar: { horizontal: false, columnWidth: '55%', borderRadius: 5 } },
                        dataLabels: { enabled: false },
                        xaxis: {
                            categories: sectionNames, labels: {
                                hideOverlappingLabels: false
                            }
                        },
                        yaxis: { title: { text: 'Number of Questions' } },
                        legend: { position: 'top', horizontalAlign: 'right' },
                        grid: { borderColor: '#f1f1f1' }
                    });
                    correctVsTotalChart.render();
                });
            </script>
        @endpush
    @endif
@endsection