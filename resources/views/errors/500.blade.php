@extends('layouts.app')

@section('title', '500 - Server Error')

@section('content')
    <div class="min-h-fit mt-12 flex items-center justify-center px-4 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-2xl w-full text-center">
            <!-- Error Icon -->
            <div class="mb-4">
                <div
                    class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full shadow-2xl mb-6">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <!-- Error Code -->
            <h1 class="text-8xl font-bold text-gray-900 mb-4">500</h1>

            <!-- Error Message -->
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Something Went Wrong</h2>
            <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto">
                We're experiencing technical difficulties. Our team has been notified and is working on it.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-army-green-700 to-army-green-600 hover:from-army-green-800 hover:to-army-green-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Back to Home
                </a>

                <button onclick="location.reload()"
                    class="inline-flex items-center px-8 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Try Again
                </button>
            </div>

            <!-- Help Text -->
            <p class="mt-8 text-sm text-gray-500">
                Error persists? Contact technical support at
                <a href="mailto:admin@asrc.mil" class="text-army-green-700 font-semibold hover:underline">admin@asrc.mil</a>
            </p>
        </div>
    </div>
@endsection