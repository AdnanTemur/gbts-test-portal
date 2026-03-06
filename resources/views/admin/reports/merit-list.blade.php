@extends('layouts.admin')

@section('title', 'Merit List')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-primary-700">Merit List</h1>
            <p class="text-sm text-gray-600 mt-1">Ranked candidate results by test version</p>
        </div>
        @if($data)
            <div class="flex gap-2">
                <a href="{{ route('admin.reports.merit-list.view', request()->query()) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow transition-colors text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print View
                </a>
                <a href="{{ route('admin.reports.merit-list.pdf', request()->query()) }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-semibold rounded-lg shadow transition-colors text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Download PDF
                </a>
            </div>
        @endif
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 mb-6">
        <form method="GET" action="{{ route('admin.reports.merit-list') }}"
            class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Test Version <span
                        class="text-red-500">*</span></label>
                <select name="test_version_id" required
                    class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">
                    <option value="">— Select Version —</option>
                    @foreach($testVersions as $version)
                        <option value="{{ $version->id }}" {{ request('test_version_id') == $version->id ? 'selected' : '' }}>
                            {{ $version->title }} ({{ $version->version_code }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Date From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}"
                    class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Date To</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}"
                    class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Result</label>
                <select name="result"
                    class="w-full px-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-100 focus:border-primary-600 outline-none">
                    <option value="all" {{ request('result', 'all') === 'all' ? 'selected' : '' }}>All Candidates</option>
                    <option value="passed" {{ request('result') === 'passed' ? 'selected' : '' }}>Passed Only</option>
                    <option value="failed" {{ request('result') === 'failed' ? 'selected' : '' }}>Failed Only</option>
                </select>
            </div>
            <div class="md:col-span-5 flex justify-end gap-3">
                <a href="{{ route('admin.reports.merit-list') }}"
                    class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    Reset
                </a>
                <button type="submit"
                    class="px-5 py-2 text-sm bg-linear-to-r from-primary-700 to-primary-600 hover:from-primary-800 hover:to-primary-700 text-white font-semibold rounded-lg shadow transition-all">
                    Generate Merit List
                </button>
            </div>
        </form>
    </div>

    @if($data)
        <!-- Summary Cards -->
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-6">
            @php
                $cards = [
                    ['label' => 'Total Candidates', 'value' => $data['summary']['total'], 'color' => 'blue'],
                    ['label' => 'Passed', 'value' => $data['summary']['passed'], 'color' => 'green'],
                    ['label' => 'Failed', 'value' => $data['summary']['failed'], 'color' => 'red'],
                    ['label' => 'Pass Rate', 'value' => ($data['summary']['total'] > 0 ? round($data['summary']['passed'] / $data['summary']['total'] * 100, 1) : 0) . '%', 'color' => 'purple'],
                    ['label' => 'Highest Score', 'value' => $data['summary']['highest'] . '%', 'color' => 'emerald'],
                    ['label' => 'Average Score', 'value' => $data['summary']['average'] . '%', 'color' => 'amber'],
                ];
            @endphp
            @foreach($cards as $card)
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4 text-center">
                    <div class="text-2xl font-bold text-{{ $card['color'] }}-600">{{ $card['value'] }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ $card['label'] }}</div>
                </div>
            @endforeach
        </div>

        <!-- Merit Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-5 py-3 bg-linear-to-r from-primary-700 to-primary-600 flex items-center justify-between">
                <h2 class="text-base font-semibold text-white">
                    Merit List — {{ $data['testVersion']->title }}
                    <span class="text-primary-200 font-normal text-sm ml-2">({{ $data['testVersion']->version_code }})</span>
                </h2>
                <span class="text-primary-200 text-sm">{{ $data['summary']['total'] }} candidates</span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-12">
                                Rank</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Candidate</th>
                            <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">CNIC
                            </th>
                            @foreach($data['sections'] as $section)
                                <th
                                    class="px-3 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                                    {{ Str::limit($section->name, 12) }}
                                </th>
                            @endforeach
                            <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Score
                            </th>
                            <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">%
                            </th>
                            <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Time
                            </th>
                            <th class="px-3 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Result</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($data['ranked'] as $row)
                            <tr class="hover:bg-gray-50 transition-colors {{ $loop->index < 3 ? 'bg-amber-50' : '' }}">
                                <td class="px-3 py-3 text-center">
                                    @if($row['rank'] === 1)
                                        <span
                                            class="inline-flex items-center justify-center w-7 h-7 bg-yellow-400 text-white rounded-full text-xs font-bold shadow">1</span>
                                    @elseif($row['rank'] === 2)
                                        <span
                                            class="inline-flex items-center justify-center w-7 h-7 bg-gray-400 text-white rounded-full text-xs font-bold shadow">2</span>
                                    @elseif($row['rank'] === 3)
                                        <span
                                            class="inline-flex items-center justify-center w-7 h-7 bg-amber-600 text-white rounded-full text-xs font-bold shadow">3</span>
                                    @else
                                        <span class="text-gray-500 font-medium">{{ $row['rank'] }}</span>
                                    @endif
                                </td>
                                <td class="px-3 py-3">
                                    <div class="font-semibold text-gray-900">{{ $row['candidate']->name }}</div>
                                    <div class="text-xs text-gray-500">S/O {{ $row['candidate']->father_name }}</div>
                                </td>
                                <td class="px-3 py-3 text-gray-900">{{ $row['candidate']->cnic }}</td>
                                @foreach($data['sections'] as $section)
                                    @php $ss = $row['section_scores'][$section->id] ?? null; @endphp
                                    <td class="px-3 py-3 text-center">
                                        @if($ss)
                                            <span class="font-semibold {{ $ss['percentage'] >= 60 ? 'text-green-700' : 'text-red-600' }}">
                                                {{ $ss['correct'] }}/{{ $ss['total'] }}
                                            </span>
                                            <div class="text-xs text-gray-400">{{ $ss['percentage'] }}%</div>
                                        @else
                                            <span class="text-gray-300">—</span>
                                        @endif
                                    </td>
                                @endforeach
                                <td class="px-3 py-3 text-center font-semibold text-gray-900">
                                    {{ $row['attempt']->correct_answers }}/{{ $row['attempt']->total_questions }}</td>
                                <td class="px-3 py-3 text-center">
                                    <span class="font-bold {{ $row['percentage'] >= 60 ? 'text-green-700' : 'text-red-600' }}">
                                        {{ $row['percentage'] }}%
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-center text-gray-600 text-xs">{{ gmdate('i:s', $row['time_taken']) }}</td>
                                <td class="px-3 py-3 text-center">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $row['passed'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $row['passed'] ? '✓ Pass' : '✗ Fail' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ 7 + $data['sections']->count() }}" class="px-6 py-12 text-center text-gray-400">
                                    No completed attempts found for the selected filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($data['summary']['total'] > 0)
                <div class="px-5 py-3 bg-gray-50 border-t border-gray-200 text-xs text-gray-500 flex items-center justify-between">
                    <span>Generated: {{ now()->format('M d, Y g:i A') }}</span>
                    <span>Ranked by: Score → Time → Name</span>
                </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-12 text-center text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <p class="font-medium">Select a test version above to generate the merit list</p>
        </div>
    @endif
@endsection