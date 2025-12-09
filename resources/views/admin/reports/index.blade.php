@extends('layouts.admin')

@section('title', 'Reports')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Reports & Analytics</h1>
    <p class="text-gray-600 mt-1">Generate comprehensive reports and analyze test data</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Candidate-wise Report -->
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
        <div class="p-6">
            <div class="text-4xl mb-4">👥</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Candidate-wise Report</h3>
            <p class="text-gray-600 text-sm mb-4">
                View detailed performance history for individual candidates including all test attempts and section-wise breakdown.
            </p>
            <a href="{{ route('admin.candidates.index') }}" 
               class="inline-block bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-2 px-6 rounded-lg">
                View Candidates
            </a>
        </div>
    </div>

    <!-- Category-wise Report -->
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
        <div class="p-6">
            <div class="text-4xl mb-4">📊</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Category-wise Report</h3>
            <p class="text-gray-600 text-sm mb-4">
                Analyze performance by test sections. View average scores, difficulty analysis, and top 10 most missed questions.
            </p>
            <form action="{{ route('admin.reports.category-wise') }}" method="GET" class="space-y-3">
                <select name="test_version_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">All Versions</option>
                    @foreach($testVersions as $version)
                        <option value="{{ $version->id }}">{{ $version->title }}</option>
                    @endforeach
                </select>
                <button type="submit" class="w-full bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-2 px-6 rounded-lg">
                    Generate Report
                </button>
            </form>
        </div>
    </div>

    <!-- Overall Report -->
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
        <div class="p-6">
            <div class="text-4xl mb-4">📈</div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Overall Statistics</h3>
            <p class="text-gray-600 text-sm mb-4">
                View comprehensive statistics including pass rates, average scores, and performance trends with date filtering.
            </p>
            <form action="{{ route('admin.reports.overall') }}" method="GET" class="space-y-3">
                <select name="test_version_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">All Versions</option>
                    @foreach($testVersions as $version)
                        <option value="{{ $version->id }}">{{ $version->title }}</option>
                    @endforeach
                </select>
                <input type="date" name="start_date" placeholder="Start Date" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">
                <input type="date" name="end_date" placeholder="End Date" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm">
                <button type="submit" class="w-full bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-2 px-6 rounded-lg">
                    Generate Report
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="mt-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">Quick Statistics</h2>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-army-green-700">
                {{ \App\Models\Candidate::count() }}
            </div>
            <div class="text-sm text-gray-600 mt-1">Total Candidates</div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-blue-600">
                {{ \App\Models\TestAttempt::where('status', 'completed')->count() }}
            </div>
            <div class="text-sm text-gray-600 mt-1">Completed Tests</div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-green-600">
                {{ \App\Models\TestAttempt::where('passed', true)->count() }}
            </div>
            <div class="text-sm text-gray-600 mt-1">Passed</div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-red-600">
                {{ \App\Models\TestAttempt::where('status', 'completed')->where('passed', false)->count() }}
            </div>
            <div class="text-sm text-gray-600 mt-1">Failed</div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 text-center">
            <div class="text-3xl font-bold text-purple-600">
                {{ \App\Models\TestAttempt::where('status', 'completed')->count() > 0 ? number_format((\App\Models\TestAttempt::where('passed', true)->count() / \App\Models\TestAttempt::where('status', 'completed')->count()) * 100, 1) : 0 }}%
            </div>
            <div class="text-sm text-gray-600 mt-1">Pass Rate</div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="mt-8 bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">Recent Test Activity</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Candidate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Test Version</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Result</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach(\App\Models\TestAttempt::with('candidate', 'testVersion')->where('status', 'completed')->latest()->limit(10)->get() as $attempt)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $attempt->completed_at->format('M d, H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $attempt->candidate->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ Str::limit($attempt->testVersion->title, 30) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $attempt->percentage >= 60 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $attempt->percentage }}%
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full {{ $attempt->passed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $attempt->passed ? 'Passed' : 'Failed' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection