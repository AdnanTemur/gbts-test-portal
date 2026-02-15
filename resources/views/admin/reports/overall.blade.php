@extends('layouts.admin')

@section('title', 'Overall Report')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-primary-700">Overall Statistics Report</h1>
                    <p class="text-gray-600 mt-1">Comprehensive performance overview and analytics</p>
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

        @if(isset($report))
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                <!-- Total Candidates -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-50 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Candidates</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($report['total_candidates']) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Attempts -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-50 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Attempts</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($report['total_attempts']) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Passed -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-50 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Passed</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($report['passed_count']) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Failed -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-50 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Failed</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($report['failed_count']) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pass Rate -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 bg-indigo-50 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Pass Rate</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $report['pass_rate'] }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Score Distribution (existing) -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Score Distribution</h3>
                    <div id="scoreDistributionChart"></div>
                </div>

                <!-- Pass/Fail Pie Chart (NEW) -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pass vs Fail Overview</h3>
                    <div id="passFailPieChart"></div>
                </div>

                <!-- Section Performance -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Section Performance Trend</h3>
                    <div id="sectionAreaChart"></div>
                </div>

                <!-- Score Range Gauge (NEW - Unique) -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Average Score Gauge</h3>
                    <div id="averageScoreGauge"></div>

                    <!-- Score Stats -->
                    <div class="grid grid-cols-3 gap-3 mt-4">
                        <div class="text-center p-3 bg-green-50 rounded-lg border border-green-200">
                            <p class="text-xs text-gray-600 mb-1">Highest</p>
                            <p class="text-lg font-bold text-green-700">{{ $report['highest_score'] }}%</p>
                        </div>
                        <div class="text-center p-3 bg-blue-50 rounded-lg border border-blue-200">
                            <p class="text-xs text-gray-600 mb-1">Average</p>
                            <p class="text-lg font-bold text-blue-700">{{ $report['average_score'] }}%</p>
                        </div>
                        <div class="text-center p-3 bg-red-50 rounded-lg border border-red-200">
                            <p class="text-xs text-gray-600 mb-1">Lowest</p>
                            <p class="text-lg font-bold text-red-700">{{ $report['lowest_score'] }}%</p>
                        </div>
                    </div>
                </div>

                <!-- Section Performance Bar (Horizontal - NEW style) -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Section-wise Performance Breakdown</h3>
                    <div id="sectionHorizontalChart"></div>
                </div>
            </div>

            @push('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // 1. Score Distribution (existing - keeping it)
                        const scoreDistChart = new ApexCharts(document.querySelector("#scoreDistributionChart"), {
                            series: [{
                                name: 'Candidates',
                                data: [
                                                                                                    {{ \App\Models\TestAttempt::where('status', 'completed')->whereBetween('percentage', [0, 20])->count() }},
                                                                                                    {{ \App\Models\TestAttempt::where('status', 'completed')->whereBetween('percentage', [21, 40])->count() }},
                                                                                                    {{ \App\Models\TestAttempt::where('status', 'completed')->whereBetween('percentage', [41, 60])->count() }},
                                                                                                    {{ \App\Models\TestAttempt::where('status', 'completed')->whereBetween('percentage', [61, 80])->count() }},
                                    {{ \App\Models\TestAttempt::where('status', 'completed')->whereBetween('percentage', [81, 100])->count() }}
                                ]
                            }],
                            chart: { type: 'bar', height: 300, toolbar: { show: false } },
                            plotOptions: {
                                bar: { borderRadius: 8, distributed: true, columnWidth: '70%', dataLabels: { position: 'top' } }
                            },
                            dataLabels: {
                                enabled: true,
                                offsetY: -20,
                                style: { fontSize: '12px', fontWeight: 700, colors: ["#374151"] }
                            },
                            colors: ['#ef4444', '#f59e0b', '#eab308', '#22c55e', '#10b981'],
                            xaxis: { categories: ['0-20%', '21-40%', '41-60%', '61-80%', '81-100%'] },
                            yaxis: { title: { text: 'Number of Candidates' } },
                            legend: { show: false },
                            grid: { borderColor: '#f3f4f6' }
                        });
                        scoreDistChart.render();

                        // 2. Pass/Fail Pie Chart (NEW)
                        const passFailPieChart = new ApexCharts(document.querySelector("#passFailPieChart"), {
                            series: [{{ $report['passed_count'] }}, {{ $report['failed_count'] }}],
                            chart: { type: 'pie', height: 300 },
                            labels: ['Passed', 'Failed'],
                            colors: ['#10b981', '#ef4444'],
                            legend: { position: 'bottom' },
                            dataLabels: {
                                enabled: true,
                                formatter: function (val, opts) {
                                    return opts.w.config.series[opts.seriesIndex] + ' (' + val.toFixed(1) + '%)'
                                },
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        labels: {
                                            show: true,
                                            name: {
                                                show: true,
                                                fontSize: '14px',
                                                fontWeight: 700,
                                                color: '#374151'
                                            },
                                            value: {
                                                show: true,
                                                fontSize: '32px',
                                                fontWeight: 700,
                                                color: '#fcdb03'
                                            },
                                            total: {
                                                show: true,
                                                label: 'Total Tests',
                                                fontSize: '14px',
                                                fontWeight: 700,
                                                color: '#ffffff',
                                                formatter: () => '{{ $report['total_attempts'] }}'
                                            }
                                        }
                                    }
                                }
                            },
                            states: {
                                hover: {
                                    filter: {
                                        type: 'darken',
                                        value: 0.15
                                    },
                                },
                                active: {
                                    filter: {
                                        type: 'darken',
                                        value: 0.2
                                    }
                                }
                            }
                        });
                        passFailPieChart.render();

                        // 3. Section Area Chart (NEW - Replaces Radar)
                        const sectionData = @json($report['section_averages']);
                        const sectionNames = Object.keys(sectionData);
                        const sectionScores = Object.values(sectionData);

                        const sectionAreaChart = new ApexCharts(document.querySelector("#sectionAreaChart"), {
                            series: [{
                                name: 'Performance',
                                data: sectionScores
                            }],
                            chart: {
                                type: 'area',
                                height: 300,
                                toolbar: { show: false },
                                zoom: { enabled: false }
                            },
                            colors: ['#15803d'],
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.7,
                                    opacityTo: 0.2,
                                    stops: [0, 90, 100]
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                style: {
                                    fontSize: '11px',
                                    fontWeight: 600,
                                    colors: ['#15803d']
                                },
                                formatter: function (val) {
                                    return val.toFixed(1) + '%'
                                },
                                background: {
                                    enabled: true,
                                    foreColor: '#fff',
                                    borderRadius: 4,
                                    padding: 4,
                                    opacity: 0.9,
                                    borderWidth: 1,
                                    borderColor: '#15803d'
                                }
                            },
                            stroke: {
                                curve: 'smooth',
                                width: 2
                            },
                            xaxis: {
                                categories: sectionNames,
                                labels: {
                                    style: {
                                        fontSize: '12px',
                                        fontWeight: 600
                                    }
                                }
                            },
                            yaxis: {
                                min: 0,
                                max: 100,
                                title: {
                                    text: 'Average Score (%)',
                                    style: {
                                        fontSize: '13px',
                                        fontWeight: 600
                                    }
                                },
                                labels: {
                                    formatter: function (val) {
                                        return val.toFixed(0) + '%'
                                    }
                                }
                            },
                            grid: {
                                borderColor: '#f3f4f6',
                                strokeDashArray: 4
                            },
                            markers: {
                                size: 5,
                                colors: ['#fff'],
                                strokeColors: '#15803d',
                                strokeWidth: 2,
                                hover: {
                                    size: 7
                                }
                            },
                            tooltip: {
                                y: {
                                    formatter: function (val) {
                                        return val.toFixed(1) + '%'
                                    }
                                }
                            }
                        });
                        sectionAreaChart.render();

                        // 4. Average Score Gauge (NEW - Radial Bar)
                        const averageScoreGauge = new ApexCharts(document.querySelector("#averageScoreGauge"), {
                            series: [{{ $report['average_score'] }}],
                            chart: { type: 'radialBar', height: 250 },
                            plotOptions: {
                                radialBar: {
                                    startAngle: -135,
                                    endAngle: 135,
                                    hollow: { size: '65%' },
                                    track: {
                                        background: '#f3f4f6',
                                        strokeWidth: '100%'
                                    },
                                    dataLabels: {
                                        name: {
                                            show: true,
                                            offsetY: -10,
                                            fontSize: '14px',
                                            color: '#6b7280'
                                        },
                                        value: {
                                            offsetY: 5,
                                            fontSize: '32px',
                                            fontWeight: 'bold',
                                            color: '#111827',
                                            formatter: function (val) {
                                                return val.toFixed(1) + '%'
                                            }
                                        }
                                    }
                                }
                            },
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    shade: 'dark',
                                    type: 'horizontal',
                                    shadeIntensity: 0.5,
                                    gradientToColors: ['#10b981'],
                                    stops: [0, 100]
                                }
                            },
                            colors: ['#15803d'],
                            labels: ['Average Score']
                        });
                        averageScoreGauge.render();

                        // 5. Section Horizontal Bar (NEW - Horizontal orientation)
                        const sectionHorizontalChart = new ApexCharts(document.querySelector("#sectionHorizontalChart"), {
                            series: [{ name: 'Average Score', data: sectionScores }],
                            chart: { type: 'bar', height: 300, toolbar: { show: false } },
                            plotOptions: {
                                bar: {
                                    horizontal: true,
                                    borderRadius: 6,
                                    dataLabels: { position: 'top' }
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                offsetX: 30,
                                style: { fontSize: '12px', fontWeight: 600, colors: ['#374151'] },
                                formatter: function (val) {
                                    return val.toFixed(1) + '%'
                                }
                            },
                            colors: ['#15803d'],
                            xaxis: {
                                categories: sectionNames,
                                min: 0,
                                max: 100,
                                title: { text: 'Average Score (%)' }
                            },
                            yaxis: {
                                labels: {
                                    style: { fontSize: '13px', fontWeight: 600 }
                                }
                            },
                            grid: { borderColor: '#f3f4f6' },
                            tooltip: {
                                y: {
                                    formatter: function (val) {
                                        return val.toFixed(1) + '%'
                                    }
                                }
                            }
                        });
                        sectionHorizontalChart.render();
                    });
                </script>
            @endpush
        @else
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">No data available</h3>
                        <p class="mt-2 text-sm text-yellow-700">
                            There is no test data to display. Please select filters from the Reports page.
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection