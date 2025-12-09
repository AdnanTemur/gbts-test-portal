@extends('layouts.admin')

@section('title', 'Candidate Details')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Candidate Details</h1>
</div>

<!-- Candidate Info Card -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex items-start gap-6">
        @if($candidate->photo)
            <img src="{{ Storage::url($candidate->photo) }}" 
                 alt="{{ $candidate->name }}"
                 class="w-32 h-32 rounded-full object-cover border-4 border-army-green-600">
        @else
            <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                </svg>
            </div>
        @endif

        <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-900">{{ $candidate->name }}</h2>
            <p class="text-gray-600">S/O {{ $candidate->father_name }}</p>
            
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <span class="text-sm font-medium text-gray-600">CNIC:</span>
                    <p class="font-mono">{{ $candidate->cnic }}</p>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-600">Phone:</span>
                    <p>{{ $candidate->phone }}</p>
                </div>
                @if($candidate->email)
                    <div>
                        <span class="text-sm font-medium text-gray-600">Email:</span>
                        <p>{{ $candidate->email }}</p>
                    </div>
                @endif
                <div>
                    <span class="text-sm font-medium text-gray-600">Registered:</span>
                    <p>{{ $candidate->created_at->format('M d, Y H:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">Total Attempts</div>
        <div class="text-3xl font-bold text-army-green-700">{{ $candidate->testAttempts->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">Completed</div>
        <div class="text-3xl font-bold text-blue-600">
            {{ $candidate->testAttempts->where('status', 'completed')->count() }}
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">Best Score</div>
        <div class="text-3xl font-bold text-green-600">
            {{ $candidate->testAttempts->where('status', 'completed')->max('percentage') ?? 'N/A' }}
            @if($candidate->testAttempts->where('status', 'completed')->max('percentage'))
                %
            @endif
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600">Average Score</div>
        <div class="text-3xl font-bold text-purple-600">
            {{ $candidate->testAttempts->where('status', 'completed')->count() > 0 ? number_format($candidate->testAttempts->where('status', 'completed')->avg('percentage'), 1) : 'N/A' }}
            @if($candidate->testAttempts->where('status', 'completed')->count() > 0)
                %
            @endif
        </div>
    </div>
</div>

<!-- Test Attempts History -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-900">Test Attempts History</h2>
    </div>

    @forelse($candidate->testAttempts as $attempt)
        <div class="p-6 border-b border-gray-200 last:border-b-0">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">{{ $attempt->testVersion->title }}</h3>
                    <p class="text-sm text-gray-600">Version: {{ $attempt->testVersion->version_code }}</p>
                    <p class="text-xs text-gray-500 mt-1">
                        Started: {{ $attempt->started_at ? $attempt->started_at->format('M d, Y H:i A') : 'Not started' }}
                    </p>
                </div>
                <div class="text-right">
                    @if($attempt->status === 'completed')
                        <div class="text-3xl font-bold {{ $attempt->passed ? 'text-green-600' : 'text-red-600' }}">
                            {{ $attempt->percentage }}%
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full {{ $attempt->passed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $attempt->passed ? 'PASSED' : 'FAILED' }}
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                            {{ strtoupper(str_replace('_', ' ', $attempt->status)) }}
                        </span>
                    @endif
                </div>
            </div>

            @if($attempt->status === 'completed')
                <!-- Section-wise Performance -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                    @foreach($attempt->sectionAttempts as $sectionAttempt)
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <div class="text-xs text-gray-600 mb-1">{{ $sectionAttempt->testSection->name }}</div>
                            <div class="flex items-baseline gap-2">
                                <span class="text-lg font-bold {{ $sectionAttempt->correct_answers / max($sectionAttempt->total_questions, 1) >= 0.6 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $sectionAttempt->correct_answers }}
                                </span>
                                <span class="text-sm text-gray-600">/ {{ $sectionAttempt->total_questions }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary Stats -->
                <div class="flex gap-6 text-sm">
                    <div>
                        <span class="text-gray-600">Correct:</span>
                        <span class="font-bold text-green-600">{{ $attempt->correct_answers }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Incorrect:</span>
                        <span class="font-bold text-red-600">{{ $attempt->incorrect_answers }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Unanswered:</span>
                        <span class="font-bold text-gray-600">{{ $attempt->unanswered }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Time:</span>
                        <span class="font-bold">{{ gmdate('H:i:s', $attempt->time_taken) }}</span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('results.show', $attempt->attempt_token) }}" 
                       target="_blank"
                       class="text-blue-600 hover:text-blue-900 text-sm">
                        View Full Results →
                    </a>
                </div>
            @endif
        </div>
    @empty
        <div class="p-6 text-center text-gray-500">
            No test attempts yet
        </div>
    @endforelse
</div>

<div class="mt-6">
    <a href="{{ route('admin.candidates.index') }}" class="text-gray-600 hover:text-gray-900">
        ← Back to Candidates
    </a>
</div>
@endsection