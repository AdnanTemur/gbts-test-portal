@extends('layouts.admin')

@section('title', 'Candidates')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Candidates</h1>
    <p class="text-gray-600 mt-1">View all registered candidates and their test history</p>
</div>

<!-- Search -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form action="{{ route('admin.candidates.index') }}" method="GET" class="flex gap-4">
        <input type="text" 
               name="search" 
               value="{{ request('search') }}"
               placeholder="Search by CNIC, name, or phone..."
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg">
        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">
            Search
        </button>
        @if(request('search'))
            <a href="{{ route('admin.candidates.index') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2">
                Clear
            </a>
        @endif
    </form>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">Total Candidates</div>
        <div class="text-3xl font-bold text-army-green-700">{{ $candidates->total() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">With Photos</div>
        <div class="text-3xl font-bold text-blue-600">
            {{ \App\Models\Candidate::whereNotNull('photo')->count() }}
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">Total Attempts</div>
        <div class="text-3xl font-bold text-purple-600">
            {{ \App\Models\TestAttempt::count() }}
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">Avg Attempts/Candidate</div>
        <div class="text-3xl font-bold text-orange-600">
            {{ $candidates->total() > 0 ? number_format(\App\Models\TestAttempt::count() / $candidates->total(), 1) : 0 }}
        </div>
    </div>
</div>

<!-- Candidates Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Candidate</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Father Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">CNIC</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Attempts</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Registered</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($candidates as $candidate)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($candidate->photo)
                                <img src="{{ Storage::url($candidate->photo) }}" 
                                     alt="{{ $candidate->name }}"
                                     class="w-10 h-10 rounded-full object-cover mr-3">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $candidate->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $candidate->father_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-mono">
                        {{ $candidate->cnic }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        <div>{{ $candidate->phone }}</div>
                        @if($candidate->email)
                            <div class="text-xs">{{ $candidate->email }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                            {{ $candidate->test_attempts_count }} attempts
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $candidate->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.candidates.show', $candidate) }}" 
                           class="text-blue-600 hover:text-blue-900">
                            View Details
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        No candidates found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $candidates->links() }}
</div>
@endsection