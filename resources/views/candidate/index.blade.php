@extends('layouts.app')

@section('title', 'PMA Test Portal - Home')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-army-green-900 mb-4">
            Mock Initial PMA Test
        </h1>
        <p class="text-xl text-gray-600">
            AS & RC, Gilgit - Test Management Portal
        </p>
    </div>

    @if($testVersions->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-600 text-lg">
                No active tests available at the moment.
            </p>
            <p class="text-gray-500 text-sm mt-2">
                Please check back later or contact the administrator.
            </p>
        </div>
    @else
        <div class="space-y-6">
            @foreach($testVersions as $testVersion)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-army-green-700 text-white px-6 py-4">
                        <h3 class="text-2xl font-bold">{{ $testVersion->title }}</h3>
                        <p class="text-sm text-army-green-100 mt-1">
                            Version: {{ $testVersion->version_code }}
                        </p>
                    </div>
                    
                    <div class="p-6">
                        @if($testVersion->description)
                            <p class="text-gray-700 mb-4">
                                {{ $testVersion->description }}
                            </p>
                        @endif

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 text-center">
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-2xl font-bold text-army-green-700">
                                    {{ $testVersion->testSections->count() }}
                                </div>
                                <div class="text-sm text-gray-600">Sections</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-2xl font-bold text-army-green-700">
                                    {{ $testVersion->questions_per_section }}
                                </div>
                                <div class="text-sm text-gray-600">Questions/Section</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-2xl font-bold text-army-green-700">
                                    {{ $testVersion->section_time_limit }}
                                </div>
                                <div class="text-sm text-gray-600">Minutes/Section</div>
                            </div>
                            <div class="bg-gray-50 p-3 rounded">
                                <div class="text-2xl font-bold text-army-green-700">
                                    {{ $testVersion->pass_threshold }}%
                                </div>
                                <div class="text-sm text-gray-600">Pass Threshold</div>
                            </div>
                        </div>

                        <form action="{{ route('candidate.lookup') }}" method="POST" class="max-w-md mx-auto">
                            @csrf
                            <input type="hidden" name="test_version_id" value="{{ $testVersion->id }}">
                            
                            <div class="mb-4">
                                <label for="cnic_{{ $testVersion->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                    Enter your CNIC to begin
                                </label>
                                <input type="text" 
                                       id="cnic_{{ $testVersion->id }}"
                                       name="cnic" 
                                       placeholder="xxxxx-xxxxxxx-x"
                                       required
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-army-green-600 focus:ring focus:ring-army-green-200">
                            </div>

                            <button type="submit" 
                                    class="w-full bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                                Start Test
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
