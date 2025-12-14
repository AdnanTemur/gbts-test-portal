@extends('layouts.admin')

@section('title', 'Edit Section')

@section('content')
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-army-green-700">Edit Test Section</h1>
                    <p class="text-sm text-gray-600 mt-1">Update section information and settings</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <!-- Card Header -->
            <div class="px-5 py-3 bg-gradient-to-r from-army-green-700 to-army-green-600 border-b border-army-green-800">
                <h2 class="text-base font-semibold text-white">Section Details</h2>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.sections.update', $section) }}" method="POST" class="p-5">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <!-- Section Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Section Name <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                </svg>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name', $section->name) }}" required
                                placeholder="e.g., Verbal Reasoning"
                                class="w-full pl-9 pr-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 transition-all outline-none">
                        </div>
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Display Order -->
                    <div>
                        <label for="display_order" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Display Order <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                            </div>
                            <input type="number" id="display_order" name="display_order"
                                value="{{ old('display_order', $section->display_order) }}" required min="0" placeholder="0"
                                class="w-full pl-9 pr-3 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 transition-all outline-none">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Order in which this section appears (0 = first)</p>
                        @error('display_order')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $section->is_active) ? 'checked' : '' }}
                                class="w-4 h-4 text-army-green-700 border-gray-300 rounded focus:ring-army-green-600">
                            <span class="ml-2 text-sm font-medium text-gray-900">Mark as active</span>
                        </label>
                    </div>

                    <!-- Info Card -->
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-3 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-4 w-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-2">
                                <p class="text-xs text-blue-700">
                                    <strong>{{ $section->questions()->count() }}</strong> questions •
                                    Slug: <strong>{{ $section->slug }}</strong> •
                                    Created: <strong>{{ $section->created_at->format('M d, Y') }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-5 mt-5 border-t border-gray-200">
                    <a href="{{ route('admin.sections.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2 text-sm bg-gradient-to-r from-army-green-700 to-army-green-600 hover:from-army-green-800 hover:to-army-green-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Section
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection