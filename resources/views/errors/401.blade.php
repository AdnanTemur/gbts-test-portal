@extends('layouts.app')

@section('title', '401 - Unauthorized')

@section('content')
    <div class="min-h-fit mt-12 flex items-center justify-center px-4 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-2xl w-full text-center">
            <!-- Error Icon -->
            <div class="mb-4">
                <div
                    class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-full shadow-2xl mb-6">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>

            <!-- Error Code -->
            <h1 class="text-8xl font-bold text-gray-900 mb-4">401</h1>

            <!-- Error Message -->
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Authentication Required</h2>
            <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto">
                You need to be logged in to access this page.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center px-8 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
@endsection