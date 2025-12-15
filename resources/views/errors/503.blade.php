@extends('layouts.app')

@section('title', '503 - Service Unavailable')

@section('content')
    <div class="min-h-fit mt-12 flex items-center justify-center px-4 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-2xl w-full text-center">
            <!-- Error Icon -->
            <div class="mb-4">
                <div
                    class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full shadow-2xl mb-6">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>

            <!-- Error Code -->
            <h1 class="text-8xl font-bold text-gray-900 mb-4">503</h1>

            <!-- Error Message -->
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Under Maintenance</h2>
            <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto">
                The system is currently undergoing scheduled maintenance. We'll be back shortly.
            </p>

            <!-- Action Button -->
            <div class="flex justify-center">
                <button onclick="location.reload()"
                    class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-army-green-700 to-army-green-600 hover:from-army-green-800 hover:to-army-green-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Refresh Page
                </button>
            </div>

            <!-- Help Text -->
            <p class="mt-8 text-sm text-gray-500">
                Thank you for your patience.
            </p>
        </div>
    </div>
@endsection