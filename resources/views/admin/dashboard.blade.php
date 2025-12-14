@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-army-green-700">Dashboard</h1>
        <p class="text-gray-600 mt-1">Welcome back! Here's what's happening with your tests today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Candidates -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Candidates</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($stats['total_candidates']) }}</p>
                    <p class="text-sm text-gray-500 mt-1">Registered users</p>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Test Versions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Test Versions</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_tests'] }}</p>
                    <p class="text-sm text-green-600 mt-1 font-medium">{{ $stats['active_tests'] }} active</p>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Attempts -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Total Attempts</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($stats['total_attempts']) }}</p>
                    <p class="text-sm text-blue-600 mt-1 font-medium">{{ $stats['completed_attempts'] }} completed</p>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pass Rate -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Pass Rate</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $stats['completed_attempts'] > 0 ? round(($stats['passed_attempts'] / $stats['completed_attempts']) * 100, 1) : 0 }}%
                    </p>
                    <p class="text-sm text-gray-500 mt-1">{{ $stats['passed_attempts'] }} of
                        {{ $stats['completed_attempts'] }}</p>
                </div>
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Pass/Fail Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Test Results Overview</h2>
                    <p class="text-sm text-gray-600 mt-1">Pass vs Fail distribution</p>
                </div>
                <div class="flex-shrink-0">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Last 30 days
                    </span>
                </div>
            </div>
            <div id="passFailChart"></div>
            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $stats['passed_attempts'] }}</div>
                    <div class="text-sm text-gray-600">Passed</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-red-600">
                        {{ $stats['completed_attempts'] - $stats['passed_attempts'] }}</div>
                    <div class="text-sm text-gray-600">Failed</div>
                </div>
            </div>
        </div>

        <!-- Score Distribution Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Score Distribution</h2>
                    <p class="text-sm text-gray-600 mt-1">Performance ranges</p>
                </div>
            </div>
            <div id="scoreDistributionChart"></div>
        </div>
    </div>

    <!-- Recent Attempts & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Attempts -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900">Recent Test Attempts</h2>
                    <a href="{{ route('admin.candidates.index') }}"
                        class="text-sm font-medium text-army-green-700 hover:text-army-green-800">
                        View all →
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Candidate</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Test
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentAttempts as $attempt)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                <span
                                                    class="text-sm font-medium text-gray-600">{{ substr($attempt->candidate->name, 0, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $attempt->candidate->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $attempt->candidate->cnic }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ Str::limit($attempt->testVersion->title, 30) }}</div>
                                    <div class="text-xs text-gray-500">{{ $attempt->testVersion->version_code }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span
                                            class="text-lg font-bold {{ $attempt->percentage >= 60 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $attempt->percentage ?? 'N/A' }}%
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($attempt->status === 'completed')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $attempt->passed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            <svg class="mr-1.5 h-2 w-2 {{ $attempt->passed ? 'text-green-400' : 'text-red-400' }}"
                                                fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            {{ $attempt->passed ? 'Passed' : 'Failed' }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            {{ ucfirst(str_replace('_', ' ', $attempt->status)) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $attempt->created_at->format('M d, Y') }}
                                    <div class="text-xs text-gray-400">{{ $attempt->created_at->format('H:i A') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">No recent test attempts</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="space-y-6">
            <!-- Quick Stats Card -->
            <div class="bg-gradient-to-br from-army-green-700 to-army-green-800 rounded-lg shadow-sm p-6 text-white">
                <h3 class="text-lg font-bold mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.questions.create') }}"
                        class="block bg-army-green-900 bg-opacity-20 hover:bg-opacity-30 rounded-lg p-3 transition-all">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="text-sm font-medium">Add New Question</span>
                        </div>
                    </a>
                    <a href="{{ route('admin.test-versions.create') }}"
                        class="block bg-army-green-900 bg-opacity-20 hover:bg-opacity-30 rounded-lg p-3 transition-all">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-sm font-medium">Create Test Version</span>
                        </div>
                    </a>
                    <a href="{{ route('admin.reports.index') }}"
                        class="block bg-army-green-900 bg-opacity-20 hover:bg-opacity-30 rounded-lg p-3 transition-all">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span class="text-sm font-medium">View Reports</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- System Info Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">System Overview</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Questions</span>
                        <span class="text-sm font-bold text-gray-900">{{ \App\Models\Question::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Active Questions</span>
                        <span
                            class="text-sm font-bold text-green-600">{{ \App\Models\Question::where('is_active', true)->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Test Sections</span>
                        <span class="text-sm font-bold text-gray-900">{{ \App\Models\TestSection::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                        <span class="text-sm text-gray-600">Avg. Test Duration</span>
                        <span class="text-sm font-bold text-gray-900">
                            {{ $stats['completed_attempts'] > 0 ? gmdate('i:s', \App\Models\TestAttempt::where('status', 'completed')->avg('time_taken')) : '00:00' }}
                            min
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Pass/Fail Donut Chart
                const passFailOptions = {
                    series: [{{ $stats['passed_attempts'] }}, {{ $stats['completed_attempts'] - $stats['passed_attempts'] }}],
                    chart: {
                        type: 'donut',
                        height: 280,
                        fontFamily: 'Inter, sans-serif',
                    },
                    labels: ['Passed', 'Failed'],
                    colors: ['#10b981', '#ef4444'],
                    dataLabels: {
                        enabled: true,
                        formatter: function (val) {
                            return Math.round(val) + '%'
                        },
                        style: {
                            fontSize: '14px',
                            fontWeight: 600,
                        }
                    },
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontSize: '14px',
                        markers: {
                            width: 12,
                            height: 12,
                            radius: 12,
                        },
                        itemMargin: {
                            horizontal: 12,
                            vertical: 8
                        }
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
                                        fontSize: '14px',
                                        fontWeight: 600,
                                        color: '#6b7280',
                                        formatter: function (w) {
                                            return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                        }
                                    },
                                    value: {
                                        show: true,
                                        fontSize: '24px',
                                        fontWeight: 700,
                                        color: '#111827',
                                    }
                                }
                            }
                        }
                    },
                    stroke: {
                        width: 0
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                height: 250
                            }
                        }
                    }]
                };

                const passFailChart = new ApexCharts(document.querySelector("#passFailChart"), passFailOptions);
                passFailChart.render();

                // Score Distribution Bar Chart
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
                        height: 280,
                        fontFamily: 'Inter, sans-serif',
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 8,
                            distributed: true,
                            horizontal: false,
                            columnWidth: '60%',
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontSize: '12px',
                            fontWeight: 600,
                        }
                    },
                    colors: ['#ef4444', '#f59e0b', '#eab308', '#22c55e', '#10b981'],
                    xaxis: {
                        categories: ['0-20%', '21-40%', '41-60%', '61-80%', '81-100%'],
                        labels: {
                            style: {
                                fontSize: '12px',
                                fontWeight: 500,
                            }
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Candidates',
                            style: {
                                fontSize: '12px',
                                fontWeight: 600,
                            }
                        },
                        labels: {
                            style: {
                                fontSize: '12px',
                            }
                        }
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        borderColor: '#f3f4f6',
                        strokeDashArray: 4,
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return val + " candidates"
                            }
                        }
                    }
                };

                const scoreDistChart = new ApexCharts(document.querySelector("#scoreDistributionChart"), scoreDistOptions);
                scoreDistChart.render();
            });
        </script>
    @endpush
@endsection