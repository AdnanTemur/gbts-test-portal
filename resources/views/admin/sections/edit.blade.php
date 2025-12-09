@extends('layouts.admin')

@section('title', 'Edit Section')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900">Edit Section</h1>
    <p class="text-gray-600 mt-1">Update section details</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form action="{{ route('admin.sections.update', $section) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Section Name *</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   value="{{ old('name', $section->name) }}"
                   required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-600">
        </div>

        <div class="mb-4">
            <label for="display_order" class="block text-sm font-medium text-gray-700 mb-2">Display Order *</label>
            <input type="number" 
                   id="display_order" 
                   name="display_order" 
                   value="{{ old('display_order', $section->display_order) }}"
                   required
                   min="0"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-600">
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $section->is_active) ? 'checked' : '' }} class="mr-2">
                <span class="text-sm text-gray-700">Active</span>
            </label>
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.sections.index') }}" class="text-gray-600 hover:text-gray-900">
                ← Back to Sections
            </a>
            <button type="submit" class="bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-2 px-6 rounded-lg">
                Update Section
            </button>
        </div>
    </form>
</div>
@endsection