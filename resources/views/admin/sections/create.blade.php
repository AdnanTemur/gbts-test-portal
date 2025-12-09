@extends('layouts.admin')

@section('title', 'Create Section')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Create New Section</h1>
    <p class="text-gray-600 mt-1">Add a new test section</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form action="{{ route('admin.sections.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Section Name *</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   value="{{ old('name') }}"
                   required
                   placeholder="e.g., Verbal, Non-Verbal"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-600">
        </div>

        <div class="mb-4">
            <label for="display_order" class="block text-sm font-medium text-gray-700 mb-2">Display Order *</label>
            <input type="number" 
                   id="display_order" 
                   name="display_order" 
                   value="{{ old('display_order', 0) }}"
                   required
                   min="0"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-600">
            <p class="text-xs text-gray-500 mt-1">Order in which sections appear (0, 1, 2, 3...)</p>
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="mr-2">
                <span class="text-sm text-gray-700">Active</span>
            </label>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.sections.index') }}" class="text-gray-600 hover:text-gray-900">
                ← Back to Sections
            </a>
            <button type="submit" class="bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-2 px-6 rounded-lg">
                Create Section
            </button>
        </div>
    </form>
</div>
@endsection