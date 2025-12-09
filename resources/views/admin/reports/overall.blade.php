@extends('layouts.admin')

@section('title', 'Overall Report')

@section('content')
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Overall Statistics Report</h1>
                <p class="text-gray-600 mt-1">Comprehensive performance overview and analytics</p>
            </div>
            <a href="{{ route('admin.reports.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Reports
            </a>
        </div>
    </div>

    @if(isset($report))
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <!-- Total Candidates -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($report['total_candidates']) }}</div>
                <div class="text-sm text-gray-600">Total Candidates</div>
            </div>

            <!-- Total Attempts -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-purple-50 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($report['total_attempts']) }}</div>
                <div class="text-sm text-gray-600">Total Attempts</div>
            </div>

            <!-- Passed -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-green-50 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($report['passed_count']) }}</div>
                <div class="text-sm text-gray-600">Passed Tests</div>
            </div>

            <!-- Failed -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-red-50 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($report['failed_count']) }}</div>
                <div class="text-sm text-gray-600">Failed Tests</div>
            </div>

            <!-- Pass Rate -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <div class="p-3 bg-indigo-50 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-1">{{ $report['pass_rate'] }}%</div>
                <div class="text-sm text-gray-600">Pass Rate</div>
            </div>
        </div>

        <!-- Score Statistics & Distribution -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Score Stats Cards -->
            <div class="space-y-3">
                <!-- Highest Score -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-50 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Highest Score</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $report['highest_score'] }}%</p>
                            </div>
                        </div>
                        <div class="px-2 py-1 bg-green-50 rounded text-xs font-medium text-green-700">
                            Best
                        </div>
                    </div>
                </div>

                <!-- Average Score -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-50 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Average Score</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $report['average_score'] }}%</p>
                            </div>
                        </div>
                        <div class="px-2 py-1 bg-blue-50 rounded text-xs font-medium text-blue-700">
                            Mean
                        </div>
                    </div>
                </div>

                <!-- Lowest Score -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-2 bg-red-50 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Lowest Score</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $report['lowest_score'] }}%</p>
                            </div>
                        </div>
                        <div class="px-2 py-1 bg-red-50 rounded text-xs font-medium text-red-700">
                            Min
                        </div>
                    </div>
                </div>
            </div>

            <!-- Score Distribution Chart -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Score Distribution</h2>
                    <p class="text-sm text-gray-600 mt-1">Distribution of test scores across all attempts</p>
                </div>
                <div id="scoreDistributionChart"></div>
            </div>
        </div>

        <!-- Section-wise Performance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900">Section-wise Average Performance</h2>
                <p class="text-sm text-gray-600 mt-1">Average performance across different test sections</p>
            </div>

            <div class="space-y-6">
                @foreach($report['section_averages'] as $section => $average)
                    <div class="relative">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center">
                                <div
                                    class="w-3 h-3 rounded-full mr-3 {{ $average >= 80 ? 'bg-green-500' : ($average >= 60 ? 'bg-yellow-500' : 'bg-red-500') }}">
                                </div>
                                <span class="text-base font-semibold text-gray-900">{{ $section }}</span>
                            </div>
                            <div class="flex items-center">
                                <span
                                    class="text-2xl font-bold {{ $average >= 80 ? 'text-green-600' : ($average >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $average }}%
                                </span>
                            </div>
                        </div>
                        <div class="relative w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div class="absolute top-0 left-0 h-full rounded-full transition-all duration-500 {{ $average >= 80 ? 'bg-gradient-to-r from-green-400 to-green-600' : ($average >= 60 ? 'bg-gradient-to-r from-yellow-400 to-yellow-600' : 'bg-gradient-to-r from-red-400 to-red-600') }}"
                                style="width: {{ $average }}%">
                            </div>
                        </div>
                        <div class="flex justify-between mt-2 text-xs text-gray-500">
                            <span>0%</span>
                            <span>100%</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Score Distribution Column Chart
                    const scoreDistOptions = {
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
                        chart: {
                            type: 'bar',
                            height: 350,
                            fontFamily: 'Inter, sans-serif',
                            toolbar: {
                                show: true,
                                tools: {
                                    download: true,
                                    selection: false,
                                    zoom: false,
                                    zoomin: false,
                                    zoomout: false,
                                    pan: false,
                                    reset: false
                                }
                            }
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 8,
                                distributed: true,
                                horizontal: false,
                                columnWidth: '70%',
                                dataLabels: {
                                    position: 'top'
                                }
                            }
                        },
                        dataLabels: {
                            enabled: true,
                            offsetY: -25,
                            style: {
                                fontSize: '14px',
                                fontWeight: 700,
                                colors: ['#374151']
                            },
                            formatter: function (val) {
                                return val + " students"
                            }
                        },
                        colors: ['#ef4444', '#f59e0b', '#eab308', '#22c55e', '#10b981'],
                        xaxis: {
                            categories: ['0-20%', '21-40%', '41-60%', '61-80%', '81-100%'],
                            labels: {
                                style: {
                                    fontSize: '13px',
                                    fontWeight: 600,
                                    colors: '#6b7280'
                                }
                            },
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Number of Candidates',
                                style: {
                                    fontSize: '13px',
                                    fontWeight: 600,
                                    color: '#6b7280'
                                }
                            },
                            labels: {
                                style: {
                                    fontSize: '12px',
                                    colors: '#6b7280'
                                },
                                formatter: function (val) {
                                    return Math.floor(val)
                                }
                            }
                        },
                        legend: {
                            show: false
                        },
                        grid: {
                            borderColor: '#f3f4f6',
                            strokeDashArray: 4,
                            padding: {
                                top: 0,
                                right: 0,
                                bottom: 0,
                                left: 10
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return val + " candidate" + (val !== 1 ? "s" : "")
                                }
                            },
                            style: {
                                fontSize: '13px'
                            }
                        }
                    };

                    const scoreDistChart = new ApexCharts(document.querySelector("#scoreDistributionChart"), scoreDistOptions);
                    scoreDistChart.render();
                });
            </script>
        @endpush
    @else
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-lg">
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
                        There is no test data to display at this time. Please select filters from the Reports page or wait for
                        test attempts to be completed.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('admin.reports.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 text-sm font-medium transition-colors">
                            Go to Reports Dashboard
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection