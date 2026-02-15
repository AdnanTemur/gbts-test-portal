@extends('layouts.admin')

@section('title', 'Candidate Details')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-primary-700">Candidate Details</h1>
                <a href="{{ route('admin.candidates.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Candidates
                </a>
            </div>
        </div>

        <!-- Candidate Info Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-start gap-6">
                @if($candidate->photo)
                    <img src="{{ Storage::url($candidate->photo) }}" alt="{{ $candidate->name }}"
                        class="w-32 h-32 rounded-xl object-cover border-4 border-primary-600 shadow-lg">
                @else
                    <div
                        class="w-32 h-32 rounded-xl bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center shadow-lg">
                        <svg class="w-16 h-16 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                @endif

                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $candidate->name }}</h2>
                    <p class="text-gray-600">S/O {{ $candidate->father_name }}</p>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <span class="text-xs font-semibold text-gray-600 uppercase">CNIC</span>
                            <p class="font-mono text-sm font-medium text-gray-900 mt-1">{{ $candidate->cnic }}</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <span class="text-xs font-semibold text-gray-600 uppercase">Phone</span>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $candidate->phone }}</p>
                        </div>
                        @if($candidate->email)
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <span class="text-xs font-semibold text-gray-600 uppercase">Email</span>
                                <p class="text-sm font-medium text-gray-900 mt-1">{{ $candidate->email }}</p>
                            </div>
                        @endif
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <span class="text-xs font-semibold text-gray-600 uppercase">Registered</span>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $candidate->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center">
                    <div class="p-3 bg-primary-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total Attempts</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $candidate->testAttempts->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Completed</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $candidate->testAttempts->where('status', 'completed')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center">
                    <div class="p-3 bg-green-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Best Score</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $candidate->testAttempts->where('status', 'completed')->max('percentage') ?? 'N/A' }}
                            @if($candidate->testAttempts->where('status', 'completed')->max('percentage'))
                                <span class="text-lg">%</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-50 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Average Score</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $candidate->testAttempts->where('status', 'completed')->count() > 0 ? number_format($candidate->testAttempts->where('status', 'completed')->avg('percentage'), 1) : 'N/A' }}
                            @if($candidate->testAttempts->where('status', 'completed')->count() > 0)
                                <span class="text-lg">%</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        @if($candidate->testAttempts->where('status', 'completed')->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Score Trend Chart -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Score Trend Over Time</h3>
                    <div id="scoreTrendChart"></div>
                </div>

                <!-- Pass/Fail Distribution -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Performance Overview</h3>
                    <div id="passFailChart"></div>
                </div>

                <!-- Section-wise Performance Radar -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Section-wise Performance</h3>
                    <div id="sectionRadarChart"></div>
                </div>

                <!-- Difficulty Level Performance -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Performance by Difficulty</h3>
                    <div id="difficultyChart"></div>
                </div>

                <!-- Time Management Chart -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 lg:col-span-2">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Time Management Analysis</h3>
                    <div id="timeManagementChart"></div>
                </div>
            </div>
        @endif

        <!-- Test Attempts History -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-900">Test Attempts History</h2>
            </div>

            @forelse($candidate->testAttempts as $attempt)
                <div class="p-6 border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $attempt->testVersion->title }}</h3>
                            <p class="text-sm text-gray-600">Version: <span
                                    class="font-mono">{{ $attempt->testVersion->version_code }}</span></p>
                            <p class="text-xs text-gray-500 mt-1 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Started:
                                {{ $attempt->started_at ? $attempt->started_at->format('M d, Y H:i A') : 'Not started' }}
                            </p>
                        </div>
                        <div class="text-right">
                            @if($attempt->status === 'completed')
                                <div class="text-3xl font-bold {{ $attempt->passed ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $attempt->percentage }}%
                                </div>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $attempt->passed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $attempt->passed ? '✓ PASSED' : '✗ FAILED' }}
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                    {{ strtoupper(str_replace('_', ' ', $attempt->status)) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    @if($attempt->status === 'completed')
                        <!-- Section-wise Performance -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                            @foreach($attempt->sectionAttempts as $sectionAttempt)
                                <div
                                    class="p-3 rounded-lg border {{ $sectionAttempt->correct_answers / max($sectionAttempt->total_questions, 1) >= 0.6 ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }}">
                                    <div class="text-xs font-semibold text-gray-700 mb-1">{{ $sectionAttempt->testSection->name }}</div>
                                    <div class="flex items-baseline gap-2">
                                        <span
                                            class="text-lg font-bold {{ $sectionAttempt->correct_answers / max($sectionAttempt->total_questions, 1) >= 0.6 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $sectionAttempt->correct_answers }}
                                        </span>
                                        <span class="text-sm text-gray-600">/ {{ $sectionAttempt->total_questions }}</span>
                                    </div>
                                    <div
                                        class="mt-1 text-xs font-medium {{ $sectionAttempt->correct_answers / max($sectionAttempt->total_questions, 1) >= 0.6 ? 'text-green-700' : 'text-red-700' }}">
                                        {{ number_format(($sectionAttempt->correct_answers / max($sectionAttempt->total_questions, 1)) * 100, 0) }}%
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Summary Stats -->
                        <div class="flex flex-wrap gap-6 text-sm mb-4">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-green-600 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-600">Correct:</span>
                                <span class="font-bold text-green-600 ml-1">{{ $attempt->correct_answers }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-red-600 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span class="text-gray-600">Incorrect:</span>
                                <span class="font-bold text-red-600 ml-1">{{ $attempt->incorrect_answers }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-600 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-600">Unanswered:</span>
                                <span class="font-bold text-gray-600 ml-1">{{ $attempt->unanswered }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-600 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-600">Time:</span>
                                <span class="font-bold text-gray-900 ml-1">{{ gmdate('H:i:s', $attempt->time_taken) }}</span>
                            </div>
                        </div>

                        <div>
                            <a href="{{ route('results.show', $attempt->attempt_token) }}" target="_blank"
                                class="inline-flex items-center text-blue-600 hover:text-blue-900 text-sm font-medium">
                                View Full Results
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No test attempts</h3>
                    <p class="mt-1 text-sm text-gray-500">This candidate hasn't taken any tests yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    @if($candidate->testAttempts->where('status', 'completed')->count() > 0)
        @if($candidate->testAttempts->where('status', 'completed')->count() > 0)
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Prepare data for charts
            const completedAttempts = @json($candidate->testAttempts->where('status', 'completed')->values());
            
            // 1. Score Trend Chart
            const scoreTrendOptions = {
                series: [{
                    name: 'Score',
                    data: completedAttempts.map(attempt => attempt.percentage)
                }],
                chart: {
                    type: 'line',
                    height: 300,
                    toolbar: { show: true }
                },
                colors: ['#15803d'],
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                markers: {
                    size: 5,
                    strokeWidth: 2,
                    fillOpacity: 1,
                    strokeOpacity: 1
                },
                xaxis: {
                    categories: completedAttempts.map((_, index) => 'Attempt ' + (index + 1)),
                    title: { text: 'Test Attempts' }
                },
                yaxis: {
                    title: { text: 'Score (%)' },
                    min: 0,
                    max: 100
                },
                grid: {
                    borderColor: '#f1f1f1'
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + '%'
                        }
                    }
                }
            };
            const scoreTrendChart = new ApexCharts(document.querySelector("#scoreTrendChart"), scoreTrendOptions);
            scoreTrendChart.render();

            // 2. Pass/Fail Chart
            const passedCount = completedAttempts.filter(attempt => attempt.passed).length;
            const failedCount = completedAttempts.filter(attempt => !attempt.passed).length;

            const passFailOptions = {
                series: [passedCount, failedCount],
                chart: {
                    type: 'donut',
                    height: 300
                },
                labels: ['Passed', 'Failed'],
                colors: ['#16a34a', '#dc2626'],
                legend: {
                    position: 'bottom'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total Tests',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        return opts.w.config.series[opts.seriesIndex]
                    }
                }
            };
            const passFailChart = new ApexCharts(document.querySelector("#passFailChart"), passFailOptions);
            passFailChart.render();

            // 3. Section-wise Performance Radar Chart
            const sectionPerformance = {};
            completedAttempts.forEach(attempt => {
                if (attempt.section_attempts) {
                    attempt.section_attempts.forEach(section => {
                        const sectionName = section.test_section.name;
                        if (!sectionPerformance[sectionName]) {
                            sectionPerformance[sectionName] = {
                                correct: 0,
                                total: 0
                            };
                        }
                        sectionPerformance[sectionName].correct += section.correct_answers;
                        sectionPerformance[sectionName].total += section.total_questions;
                    });
                }
            });

            const sectionLabels = Object.keys(sectionPerformance);
            const sectionScores = sectionLabels.map(label => {
                const perf = sectionPerformance[label];
                return Math.round((perf.correct / perf.total) * 100);
            });

            const sectionRadarOptions = {
                series: [{
                    name: 'Accuracy',
                    data: sectionScores
                }],
                chart: {
                    type: 'radar',
                    height: 350,
                    toolbar: { show: false }
                },
                colors: ['#2563eb'],
                xaxis: {
                    categories: sectionLabels
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    tickAmount: 5
                },
                fill: {
                    opacity: 0.2
                },
                markers: {
                    size: 4
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + '%'
                        }
                    }
                }
            };
            const sectionRadarChart = new ApexCharts(document.querySelector("#sectionRadarChart"), sectionRadarOptions);
            sectionRadarChart.render();

            // 4. Difficulty Level Performance
            const difficultyPerformance = { 
                easy: {correct: 0, total: 0}, 
                medium: {correct: 0, total: 0}, 
                hard: {correct: 0, total: 0} 
            };
            
            completedAttempts.forEach(attempt => {
                if (attempt.answers) {
                    attempt.answers.forEach(answer => {
                        const diff = answer.question.difficulty_level;
                        if (difficultyPerformance[diff]) {
                            difficultyPerformance[diff].total++;
                            if (answer.is_correct) {
                                difficultyPerformance[diff].correct++;
                            }
                        }
                    });
                }
            });

            const difficultyData = ['easy', 'medium', 'hard'].map(level => {
                const perf = difficultyPerformance[level];
                return perf.total > 0 ? Math.round((perf.correct / perf.total) * 100) : 0;
            });

            const difficultyOptions = {
                series: [{
                    name: 'Accuracy',
                    data: difficultyData
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: { show: false }
                },
                colors: ['#16a34a', '#eab308', '#dc2626'],
                plotOptions: {
                    bar: {
                        distributed: true,
                        borderRadius: 8,
                        dataLabels: {
                            position: 'top'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + "%";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },
                xaxis: {
                    categories: ['Easy', 'Medium', 'Hard'],
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    title: {
                        text: 'Accuracy (%)'
                    }
                },
                legend: {
                    show: false
                },
                grid: {
                    borderColor: '#f1f1f1'
                }
            };
            const difficultyChart = new ApexCharts(document.querySelector("#difficultyChart"), difficultyOptions);
            difficultyChart.render();

            // 5. Time Management Chart
            const latestAttempt = completedAttempts[completedAttempts.length - 1];
            if (latestAttempt && latestAttempt.section_attempts) {
                const timeData = latestAttempt.section_attempts.map(section => {
                    const timeSpent = section.time_taken / 60; // Convert to minutes
                    const timeAllocated = latestAttempt.test_version.section_time_limit;
                    return {
                        section: section.test_section.name,
                        spent: Math.round(timeSpent),
                        allocated: timeAllocated
                    };
                });

                const timeManagementOptions = {
                    series: [
                        {
                            name: 'Time Spent',
                            data: timeData.map(d => d.spent)
                        },
                        {
                            name: 'Time Allocated',
                            data: timeData.map(d => d.allocated)
                        }
                    ],
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: { show: false }
                    },
                    colors: ['#3b82f6', '#10b981'],
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            borderRadius: 5
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: timeData.map(d => d.section),
                        title: {
                            text: 'Test Sections'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Time (minutes)'
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return val + " min"
                            }
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right'
                    },
                    grid: {
                        borderColor: '#f1f1f1'
                    }
                };
                const timeManagementChart = new ApexCharts(document.querySelector("#timeManagementChart"), timeManagementOptions);
                timeManagementChart.render();
            }
        });
    </script>
    @endpush
@endif
    @endif
@endsection