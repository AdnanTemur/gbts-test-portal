<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - PMA Test Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes blob {

            0%,
            100% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>

<body class="relative overflow-hidden min-h-screen">
    <!-- Animated Background -->
    <div class="fixed inset-0 bg-gradient-to-br from-army-green-900 to-army-green-800">
    </div>

    <!-- Animated Blurred Blobs - More Visible -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <!-- Large Blob - Top Right (Cyan/Green) -->
        <div
            class="absolute -top-20 -right-20 w-96 h-96 bg-gradient-to-br from-emerald-400 via-teal-300 to-cyan-400 rounded-full filter blur-3xl opacity-40 animate-blob">
        </div>

        <!-- Large Blob - Bottom Left (Yellow/Green) -->
        <!-- <div
            class="absolute -bottom-20 -left-20 w-96 h-96 bg-gradient-to-tr from-lime-300 via-green-400 to-emerald-500 rounded-full filter blur-3xl opacity-40 animate-blob animation-delay-2000">
        </div> -->

        <!-- Medium Blob - Center (Purple/Pink) -->
        <!-- <div
            class="absolute top-1/3 right-1/4 w-80 h-80 bg-gradient-to-br from-pink-300 via-rose-300 to-purple-400 rounded-full filter blur-3xl opacity-30 animate-blob animation-delay-4000">
        </div> -->

        <!-- Small Blob - Top Left (Orange) -->
        <!-- <div
            class="absolute top-10 left-10 w-64 h-64 bg-gradient-to-br from-orange-300 via-amber-300 to-yellow-400 rounded-full filter blur-2xl opacity-35 animate-blob">
        </div> -->

        <!-- Small Blob - Bottom Right (Blue) -->
        <!-- <div
            class="absolute bottom-10 right-10 w-72 h-72 bg-gradient-to-br from-blue-300 via-sky-300 to-cyan-400 rounded-full filter blur-2xl opacity-35 animate-blob animation-delay-2000">
        </div> -->

        <!-- Accent Blob - Middle Left (Green) -->
        <div
            class="absolute top-1/2 left-5 w-56 h-56 bg-gradient-to-br from-green-200 via-emerald-300 to-teal-400 rounded-full filter blur-2xl opacity-30 animate-blob animation-delay-4000">
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="max-w-md w-full">
            <!-- Logo Card - Reduced size -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-xl shadow-2xl mb-3">
                    <svg class="w-8 h-8 text-army-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-1 drop-shadow-lg">PMA Admin Panel</h1>
                <p class="text-army-green-100">AS & RC, Gilgit</p>
            </div>

            <!-- Login Card - Reduced padding -->
            <div class="bg-white/95 backdrop-blur-lg rounded-xl shadow-2xl p-6 border border-white/20">
                <div class="mb-5">
                    <h2 class="text-xl font-bold text-gray-900 mb-1">Welcome Back</h2>
                    <p class="text-sm text-gray-600">Sign in to access your dashboard</p>
                </div>

                @if($errors->any())
                    <div x-data="{ show: true }" x-show="show" x-transition
                        class="relative bg-red-50 border-l-4 border-red-500 text-red-700 px-3 py-2.5 rounded-lg mb-4">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-medium">{{ $errors->first() }}</span>
                        </div>
                        <button @click="show = false" class="absolute top-2 right-2 text-red-500 hover:text-red-700">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                placeholder="admin@asrc.mil"
                                class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-300 rounded-lg focus:ring-4 focus:ring-army-green-100 focus:border-army-green-600 transition-all outline-none text-sm">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" required placeholder="••••••••"
                                class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-300 rounded-lg focus:ring-4 focus:ring-army-green-100 focus:border-army-green-600 transition-all outline-none text-sm">
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center pt-1">
                        <input type="checkbox" id="remember" name="remember"
                            class="w-4 h-4 text-army-green-700 border-gray-300 rounded focus:ring-army-green-600">
                        <label for="remember" class="ml-2 text-sm text-gray-700">
                            Remember me for 30 days
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-army-green-700 to-army-green-600 hover:from-army-green-800 hover:to-army-green-700 text-white font-bold py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center group mt-5">
                        <span>Sign In</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-5">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">or</span>
                    </div>
                </div>

                <!-- Back to Portal Link -->
                <a href="{{ route('home') }}"
                    class="flex items-center justify-center text-sm text-gray-600 hover:text-army-green-700 font-medium transition-colors group">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Public Portal
                </a>
            </div>

            <!-- Footer Info -->
            <div class="mt-6 text-center">
                <p class="text-army-green-100 text-sm">
                    &copy; {{ date('Y') }} Pakistan Military Academy. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>