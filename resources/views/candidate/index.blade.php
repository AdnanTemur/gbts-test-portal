@extends('layouts.app')

@section('title', config('app.name', 'GBTS Test Portal') . ' - Home')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <!-- Hero Section -->
        <div class="relative h-screen w-full mb-12">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="https://images.pexels.com/photos/31359466/pexels-photo-31359466.jpeg"
                    alt="Mountains" class="w-full h-full object-cover">
                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-black/50"></div>
                <!-- Green Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-primary-900/80 via-transparent to-transparent"></div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 h-full flex flex-col justify-center items-center px-4 text-center pt-16 pb-48">
                <!-- Badge -->
                <div
                    class="inline-flex items-center px-4 py-2 bg-primary-600/90 backdrop-blur-sm rounded-full mb-6 shadow-lg">
                    <svg class="w-4 h-4 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-xs font-semibold text-white tracking-wide">GBTS,
                        Gilgit-Baltistan</span>
                </div>

                <!-- Main Title -->
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 tracking-tight drop-shadow-lg">
                    GBTS Computer Based Test
                </h1>

                <!-- Subtitle -->
                <p class="text-base md:text-lg text-white/90 mb-8 max-w-2xl leading-relaxed">
                    Prepare for success with our comprehensive assessment portal designed for aspiring candidates.
                </p>

                <!-- CTA Button -->
                <a href="#tests"
                    class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold text-base rounded-full transition-all duration-300 shadow-xl hover:shadow-primary-500/30 transform hover:scale-105 group">
                    <span>Get Started</span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <!-- Stats Row - Fixed at bottom -->
            <div class="absolute bottom-20 left-0 right-0 z-20 px-4">
                <div class="max-w-3xl mx-auto">
                    <div class="grid grid-cols-3 gap-4 bg-white/10 backdrop-blur-md rounded-xl p-4 border border-white/20">
                        <div class="text-center">
                            <div class="text-2xl md:text-3xl font-bold text-white">{{ $testVersions->count() }}</div>
                            <div class="text-xs text-white/70 mt-1 font-medium">Active Tests</div>
                        </div>
                        <div class="text-center border-x border-white/20">
                            <div class="text-2xl md:text-3xl font-bold text-white">
                                {{ $testVersions->sum(fn($t) => $t->testSections->count()) }}
                            </div>
                            <div class="text-xs text-white/70 mt-1 font-medium">Total Sections</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl md:text-3xl font-bold text-white">24/7</div>
                            <div class="text-xs text-white/70 mt-1 font-medium">Available</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20">
                <a href="#tests" class="text-white/60 hover:text-white transition-colors">
                    <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8" id="tests">
            @if($testVersions->isEmpty())
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-200">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Active Tests</h3>
                    <p class="text-gray-600 text-lg mb-2">
                        No tests are currently available.
                    </p>
                    <p class="text-gray-500 text-sm">
                        Please check back later or contact the administrator for more information.
                    </p>
                </div>
            @else
                <!-- Test Cards -->
                <div class="space-y-8">
                    @foreach($testVersions as $testVersion)
                        <div
                            class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                            <!-- Header -->
                            <div class="bg-gradient-to-r from-primary-700 to-primary-600 px-8 py-6">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-3xl font-bold text-white mb-2">{{ $testVersion->title }}</h3>
                                        <div class="inline-flex items-center px-3 py-1 bg-white bg-opacity-20 rounded-full">
                                            <svg class="w-4 h-4 text-primary-900 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            <span
                                                class="text-sm font-medium text-primary-900 text-center">{{ $testVersion->version_code }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span
                                            class="inline-flex items-center px-4 py-2 bg-white rounded-lg text-primary-700 font-bold">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Active
                                        </span>
                                    </div>
                                </div>
                                @if($testVersion->description)
                                    <p class="text-primary-50 mt-4 text-sm leading-relaxed">
                                        {{ $testVersion->description }}
                                    </p>
                                @endif
                            </div>

                            <div class="p-8">
                                <!-- Stats Grid -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                                    <div
                                        class="bg-gradient-to-br from-blue-50 to-blue-100 px-5 py-3 rounded-xl border border-blue-200">
                                        <div class="flex items-center mb-2">
                                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold text-blue-900 mb-1">
                                            {{ $testVersion->testSections->count() }}
                                        </div>
                                        <div class="text-sm font-medium text-blue-700">Sections</div>
                                    </div>

                                    <div
                                        class="bg-gradient-to-br from-purple-50 to-purple-100 px-5 py-3 rounded-xl border border-purple-200">
                                        <div class="flex items-center mb-2">
                                            <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold text-purple-900 mb-1">
                                            {{ $testVersion->questions_per_section }}
                                        </div>
                                        <div class="text-sm font-medium text-purple-700">Questions/Section</div>
                                    </div>

                                    <div
                                        class="bg-gradient-to-br from-amber-50 to-amber-100 px-5 py-3 rounded-xl border border-amber-200">
                                        <div class="flex items-center mb-2">
                                            <div class="w-8 h-8 bg-amber-600 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold text-amber-900 mb-1">
                                            {{ $testVersion->section_time_limit }}
                                        </div>
                                        <div class="text-sm font-medium text-amber-700">Minutes/Section</div>
                                    </div>

                                    <div
                                        class="bg-gradient-to-br from-green-50 to-green-100 px-5 py-3 rounded-xl border border-green-200">
                                        <div class="flex items-center mb-2">
                                            <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold text-green-900 mb-1">
                                            {{ $testVersion->pass_threshold }}%
                                        </div>
                                        <div class="text-sm font-medium text-green-700">Pass Threshold</div>
                                    </div>
                                </div>

                                <!-- CNIC Input Form -->
                                <div class="max-w-md mx-auto">
                                    <form action="{{ route('candidate.lookup') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="test_version_id" value="{{ $testVersion->id }}">

                                        <div class="mb-6">
                                            <label for="cnic_{{ $testVersion->id }}"
                                                class="block text-sm font-semibold text-gray-700 mb-3">
                                                <span class="flex items-center">
                                                    <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                    </svg>
                                                    Enter your CNIC Number
                                                </span>
                                            </label>
                                            <input type="text" id="cnic_{{ $testVersion->id }}" name="cnic"
                                                placeholder="12345-1234567-1" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" required
                                                class="w-full px-5 py-2 text-lg border-2 border-gray-300 rounded-xl focus:border-primary-600 focus:ring-4 focus:ring-primary-100 transition-all outline-none">
                                            <p class="mt-2 text-xs text-gray-500">Format: xxxxx-xxxxxxx-x</p>
                                        </div>

                                        <button type="submit"
                                            class="w-full bg-gradient-to-r from-primary-700 to-primary-600 hover:from-primary-800 hover:to-primary-700 text-white font-bold py-2 px-6 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center group">
                                            <span class="text-lg">Start Test</span>
                                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Footer Info -->
                            <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
                                <div class="flex items-center justify-between text-sm">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Make sure you have a stable internet connection</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Total Duration:
                                            {{ $testVersion->testSections->count() * $testVersion->section_time_limit }}
                                            minutes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Help Section -->
            <div class="mt-12 text-center">
                <p class="text-gray-600">
                    Need help? Contact the administrator at
                    <a href="mailto:admin@gbtsportal.com"
                        class="text-primary-700 font-semibold hover:underline">admin@gbtsportal.com</a>
                </p>
            </div>
        </div>
    </div>
@endsection