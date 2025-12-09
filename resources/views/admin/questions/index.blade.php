@extends('layouts.admin')

@section('title', 'Questions')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Questions</h1>
        <p class="text-gray-600 mt-1">Manage test questions (MCQ, True/False, Matching)</p>
    </div>
    <a href="{{ route('admin.questions.create') }}" 
       class="bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-2 px-6 rounded-lg">
        + New Question
    </a>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form action="{{ route('admin.questions.index') }}" method="GET" class="flex gap-4">
        <select name="section_id" class="px-4 py-2 border border-gray-300 rounded-lg">
            <option value="">All Sections</option>
            @foreach($sections as $section)
                <option value="{{ $section->id }}" {{ request('section_id') == $section->id ? 'selected' : '' }}>
                    {{ $section->name }}
                </option>
            @endforeach
        </select>

        <select name="question_type" class="px-4 py-2 border border-gray-300 rounded-lg">
            <option value="">All Types</option>
            <option value="mcq" {{ request('question_type') == 'mcq' ? 'selected' : '' }}>MCQ</option>
            <option value="true_false" {{ request('question_type') == 'true_false' ? 'selected' : '' }}>True/False</option>
            <option value="matching" {{ request('question_type') == 'matching' ? 'selected' : '' }}>Matching</option>
        </select>

        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">
            Filter
        </button>
        <a href="{{ route('admin.questions.index') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2">
            Clear
        </a>
    </form>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Question</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Section</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Difficulty</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Marks</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($questions as $question)
                <tr>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ Str::limit($question->question_text, 60) }}</div>
                        @if($question->question_image)
                            <span class="text-xs text-blue-600">📷 Has image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $question->testSection->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                            {{ strtoupper(str_replace('_', ' ', $question->question_type)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs rounded-full {{ $question->difficulty_level == 'easy' ? 'bg-green-100 text-green-800' : ($question->difficulty_level == 'medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($question->difficulty_level) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $question->marks }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs rounded-full {{ $question->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $question->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.questions.edit', $question) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                        <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this question?')" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        No questions found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $questions->links() }}
</div>
@endsection