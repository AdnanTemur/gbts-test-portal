@extends('layouts.app')

@section('title', 'Confirm Details - PMA Test Portal')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold text-army-green-900 mb-6">Welcome Back!</h1>
        
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <p class="text-blue-800">
                We found your existing record. Please confirm your details to start a new test attempt.
            </p>
        </div>

        <div class="space-y-4 mb-6">
            <div class="flex items-center">
                @if($candidate->photo)
                    <img src="{{ Storage::url($candidate->photo) }}" 
                         alt="{{ $candidate->name }}"
                         class="w-24 h-24 rounded-full object-cover border-4 border-army-green-600 mr-6">
                @else
                    <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center mr-6">
                        <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                @endif
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $candidate->name }}</h2>
                    <p class="text-gray-600">S/O {{ $candidate->father_name }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                <div>
                    <span class="text-sm font-medium text-gray-600">CNIC:</span>
                    <p class="text-gray-900">{{ $candidate->cnic }}</p>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-600">Phone:</span>
                    <p class="text-gray-900">{{ $candidate->phone }}</p>
                </div>
                @if($candidate->email)
                <div>
                    <span class="text-sm font-medium text-gray-600">Email:</span>
                    <p class="text-gray-900">{{ $candidate->email }}</p>
                </div>
                @endif
            </div>
        </div>

        <div class="bg-army-green-50 border border-army-green-200 rounded-lg p-4 mb-6">
            <h3 class="font-semibold text-army-green-900 mb-2">Test Details:</h3>
            <p class="text-army-green-800"><strong>{{ $testVersion->title }}</strong></p>
            <p class="text-sm text-army-green-700">Version: {{ $testVersion->version_code }}</p>
        </div>

        <form action="{{ route('candidate.register') }}" method="POST">
            @csrf
            <input type="hidden" name="test_version_id" value="{{ $testVersion->id }}">
            <input type="hidden" name="cnic" value="{{ $candidate->cnic }}">
            <input type="hidden" name="name" value="{{ $candidate->name }}">
            <input type="hidden" name="father_name" value="{{ $candidate->father_name }}">
            <input type="hidden" name="phone" value="{{ $candidate->phone }}">
            <input type="hidden" name="email" value="{{ $candidate->email }}">

            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" 
                   class="text-gray-600 hover:text-gray-900">
                    ← Back to Home
                </a>
                <button type="submit"
                        class="bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-3 px-8 rounded-lg transition-colors">
                    Start New Test Attempt
                </button>
            </div>
        </form>
    </div>
</div>
@endsection