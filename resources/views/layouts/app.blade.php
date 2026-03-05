<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <title>@yield('title', config('app.name', 'GBTS Test Portal'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    @include('components.public.navbar')

    <main class="flex-1">

        <div class="fixed top-20 left-0 right-0 z-999 flex flex-col items-center gap-4">

            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4" id="alert-success">
                    <div
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded flex items-center gap-4">
                        <span>
                            {{ session('success') }}
                        </span>
                        <button onclick="dismissAlert('alert-success')" class="font-bold text-lg leading-none">
                            &times;
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded flex items-center gap-4"
                    id="alert-error">
                    <span>
                        {{ session('error') }}
                    </span>
                    <button onclick="dismissAlert('alert-error')" class="font-bold text-lg leading-none">
                        &times;
                    </button>
                </div>
            @endif

            @if(session('info'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded flex items-center gap-4"
                    id="alert-info">
                    <span>
                        {{ session('info') }}
                    </span>
                    <button onclick="dismissAlert('alert-info')" class="font-bold text-lg leading-none">
                        &times;
                    </button>
                </div>
            @endif

        </div>

        @yield('content')

    </main>

    @include('components.public.footer')

    @stack('scripts')

</body>

</html>