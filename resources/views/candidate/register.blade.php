@extends('layouts.app')
@section('title', 'Register - ' . config('app.name', 'GBTS Test Portal'))

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-12 bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-2xl w-full">
            <!-- Header -->
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-army-green-700 to-army-green-600 rounded-full mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Candidate Registration</h1>
                <p class="text-gray-600">Complete your registration to begin the test</p>
            </div>

            <!-- Registration Card -->
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                <!-- Card Header -->
                <div class="px-8 py-5 bg-gradient-to-r from-army-green-700 to-army-green-600 border-b">
                    <h2 class="text-lg font-semibold text-white">Personal Information</h2>
                    <p class="text-sm text-white/80 mt-1">Please fill in all required details accurately</p>
                </div>

                <!-- Form -->
                <form action="{{ route('candidate.register') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    <input type="hidden" name="test_version_id" value="{{ $testVersion->id }}">
                    <input type="hidden" name="cnic" value="{{ $cnic }}">

                    <div class="space-y-6">
                        <!-- CNIC (Disabled) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <svg class="w-4 h-4 inline-block mr-1 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                                CNIC Number
                            </label>
                            <input type="text" value="{{ $cnic }}" disabled
                                class="w-full px-4 py-2 text-sm font-mono bg-gray-100 border-2 border-gray-300 rounded-lg text-gray-700 cursor-not-allowed">
                            <p class="text-xs text-gray-500 mt-1.5">Your verified CNIC number</p>
                        </div>

                        <!-- Full Name -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none transition-colors"
                                placeholder="Enter your full name as per CNIC">
                            <p class="text-xs text-gray-500 mt-1.5">Enter your complete name as it appears on official
                                documents</p>
                        </div>

                        <!-- Father Name -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Father's Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="father_name" required
                                class="w-full px-4 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none transition-colors"
                                placeholder="Enter father's name">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="phone" required
                                class="w-full px-4 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none transition-colors"
                                placeholder="03XX-XXXXXXX">
                            <p class="text-xs text-gray-500 mt-1.5">Enter a valid contact number</p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <input type="email" name="email"
                                class="w-full px-4 py-2 text-sm border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none transition-colors"
                                placeholder="your.email@example.com">
                            <p class="text-xs text-gray-500 mt-1.5">Optional - for receiving test results and notifications
                            </p>
                        </div>

                        <!-- Photo Upload -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <svg class="w-4 h-4 inline-block mr-1 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Upload Photo <span class="text-gray-400 text-xs">(Optional)</span>
                            </label>
                            <div class="mt-2">
                                <input type="file" name="photo" accept="image/jpeg,image/jpg,image/png" id="photoInput"
                                    class="block w-full text-sm text-gray-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-army-green-50 file:text-army-green-700 hover:file:bg-army-green-100 file:cursor-pointer cursor-pointer border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-army-green-100 focus:border-army-green-600 outline-none transition-colors">
                            </div>
                            <div class="mt-3 p-3 bg-blue-50 border-l-4 border-blue-400 rounded-r-lg">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="text-xs text-blue-700">
                                        <p class="font-semibold mb-1">Photo Requirements:</p>
                                        <ul class="list-disc list-inside space-y-0.5">
                                            <li>Square ratio (1:1) recommended</li>
                                            <li>JPEG, JPG, or PNG format only</li>
                                            <li>Maximum file size: 2MB</li>
                                            <li>Clear, recent photograph with plain background</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreview" class="hidden">
                            <p class="text-sm font-semibold text-gray-700 mb-2">Photo Preview:</p>
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <img id="previewImage" src="" alt="Preview"
                                    class="w-24 h-24 rounded-lg object-cover border-2 border-gray-300">
                                <div>
                                    <p class="text-sm font-medium text-gray-900" id="fileName"></p>
                                    <p class="text-xs text-gray-500" id="fileSize"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="my-8 border-t border-gray-200"></div>

                    <!-- Important Notice -->
                    <div class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded-r-lg">
                        <div class="flex">
                            <svg class="w-5 h-5 text-yellow-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div class="text-sm text-yellow-800">
                                <p class="font-semibold mb-1">Important Notice</p>
                                <p>Please ensure all information is accurate. Once you submit and start the test, you cannot
                                    modify these details.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-army-green-700 to-army-green-600 hover:from-army-green-800 hover:to-army-green-700 text-white font-bold py-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Register & Start Test
                    </button>
                </form>
            </div>

            <!-- Footer Note -->
            <p class="text-center text-sm text-gray-600 mt-6">
                Need help? Contact the test administrator
            </p>
        </div>
    </div>

    @push('scripts')
        <script>
            // Image preview functionality
            document.getElementById('photoInput').addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    const preview = document.getElementById('imagePreview');
                    const previewImage = document.getElementById('previewImage');
                    const fileName = document.getElementById('fileName');
                    const fileSize = document.getElementById('fileSize');

                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        fileName.textContent = file.name;
                        fileSize.textContent = (file.size / 1024).toFixed(2) + ' KB';
                        preview.classList.remove('hidden');
                    }

                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
@endsection