@extends('layouts.app')

@section('title', 'Confirm Details - ' . config('app.name', 'GBTS Test Portal'))

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-12 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-3xl w-full">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-primary-700 to-primary-600 rounded-full mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back!</h1>
                <p class="text-gray-600">We found your existing record. Please confirm your details to continue.</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <!-- Notice Banner -->
                <div class="px-8 py-4 bg-gradient-to-r from-primary-700 to-primary-600 border-b">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-white mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="text-white">
                            <p class="font-semibold text-sm">Existing Record Found</p>
                            <p class="text-sm text-blue-100 mt-1">Your information has been retrieved. Verify the details below to start a new test attempt.</p>
                        </div>
                    </div>
                </div>

                <!-- Candidate Information -->
                <div class="p-8">
                    <!-- Profile Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Candidate Profile</h3>
                        <div class="flex items-start gap-6">
                            @if($candidate->photo)
                                <img src="{{ Storage::url($candidate->photo) }}" 
                                     alt="{{ $candidate->name }}"
                                     class="w-28 h-28 rounded-xl object-cover border-4 border-primary-600 shadow-lg flex-shrink-0">
                            @else
                                <div class="w-28 h-28 rounded-xl bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center border-4 border-gray-400 shadow-lg flex-shrink-0">
                                    <svg class="w-14 h-14 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @endif

                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $candidate->name }}</h2>
                                <p class="text-gray-600 mb-4">S/O {{ $candidate->father_name }}</p>

                                <!-- Details Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                        <div class="flex items-center mb-1">
                                            <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                            </svg>
                                            <span class="text-xs font-semibold text-gray-600 uppercase">CNIC</span>
                                        </div>
                                        <p class="text-sm font-mono font-semibold text-gray-900">{{ $candidate->cnic }}</p>
                                    </div>

                                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                        <div class="flex items-center mb-1">
                                            <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            <span class="text-xs font-semibold text-gray-600 uppercase">Phone</span>
                                        </div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $candidate->phone }}</p>
                                    </div>

                                    @if($candidate->email)
                                        <div class="p-3 bg-gray-50 rounded-lg border border-gray-200 md:col-span-2">
                                            <div class="flex items-center mb-1">
                                                <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                <span class="text-xs font-semibold text-gray-600 uppercase">Email</span>
                                            </div>
                                            <p class="text-sm font-semibold text-gray-900">{{ $candidate->email }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Test Details Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Test Information</h3>
                        <div class="p-5 bg-gradient-to-r from-primary-50 to-emerald-50 rounded-xl border-2 border-primary-200">
                            <div class="flex items-start">
                                <div class="p-3 bg-white rounded-lg shadow-sm mr-4">
                                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-primary-700 uppercase mb-1">Test Version</p>
                                    <h4 class="text-xl font-bold text-primary-900 mb-2">{{ $testVersion->title }}</h4>
                                    <div class="inline-flex items-center px-3 py-1 bg-white rounded-lg border border-primary-300 shadow-sm">
                                        <svg class="w-4 h-4 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        <span class="text-sm font-mono font-semibold text-primary-800">{{ $testVersion->version_code }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Previous Attempts Notice (if any) -->
                    @if($candidate->testAttempts->count() > 0)
                        <div class="mb-8 p-4 bg-amber-50 border-l-4 border-amber-400 rounded-r-lg">
                            <div class="flex">
                                <svg class="w-5 h-5 text-amber-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="text-sm text-amber-800">
                                    <p class="font-semibold mb-1">Previous Test Record</p>
                                    <p>You have completed <span class="font-bold">{{ $candidate->testAttempts->count() }}</span> test attempt(s) previously. This will be a new attempt.</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('candidate.register') }}" method="POST">
                        @csrf
                        <input type="hidden" name="test_version_id" value="{{ $testVersion->id }}">
                        <input type="hidden" name="cnic" value="{{ $candidate->cnic }}">
                        <input type="hidden" name="name" value="{{ $candidate->name }}">
                        <input type="hidden" name="father_name" value="{{ $candidate->father_name }}">
                        <input type="hidden" name="phone" value="{{ $candidate->phone }}">
                        <input type="hidden" name="email" value="{{ $candidate->email }}">

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('home') }}" 
                               class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Back to Home
                            </a>

                            <button type="submit"
                                    class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-primary-700 to-primary-600 hover:from-primary-800 hover:to-primary-700 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                                Start New Test Attempt
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Note -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Ensure your details are correct before proceeding
            </p>
        </div>
    </div>
@endsection