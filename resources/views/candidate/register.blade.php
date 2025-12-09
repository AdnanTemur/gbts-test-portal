@extends('layouts.app')
@section('title', 'Register - PMA Test Portal')
@section('content')
<div class="max-w-2xl mx-auto px-4">
    <div class="bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold text-army-green-900 mb-6">Candidate Registration</h1>
        <form action="{{ route('candidate.register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="test_version_id" value="{{ $testVersion->id }}">
            <input type="hidden" name="cnic" value="{{ $cnic }}">
            <div class="space-y-4">
                <div><label class="block text-sm font-medium mb-1">CNIC</label><input type="text" value="{{ $cnic }}" disabled class="w-full px-4 py-2 border rounded-lg bg-gray-100"></div>
                <div><label class="block text-sm font-medium mb-1">Full Name *</label><input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg"></div>
                <div><label class="block text-sm font-medium mb-1">Father Name *</label><input type="text" name="father_name" required class="w-full px-4 py-2 border rounded-lg"></div>
                <div><label class="block text-sm font-medium mb-1">Phone *</label><input type="text" name="phone" required class="w-full px-4 py-2 border rounded-lg"></div>
                <div><label class="block text-sm font-medium mb-1">Email (Optional)</label><input type="email" name="email" class="w-full px-4 py-2 border rounded-lg"></div>
                <div><label class="block text-sm font-medium mb-1">Photo (Optional, 1:1 square, max 2MB)</label><input type="file" name="photo" accept="image/jpeg,image/jpg,image/png" class="w-full px-4 py-2 border rounded-lg"></div>
                <button type="submit" class="w-full bg-army-green-700 hover:bg-army-green-800 text-white font-bold py-3 rounded-lg">Register & Start Test</button>
            </div>
        </form>
    </div>
</div>
@endsection
