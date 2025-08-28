<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Notes App') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen flex flex-col">

    <!-- Navigation -->
    <nav class="bg-white/90 backdrop-blur-md shadow-md sticky top-0 z-50">
        @include('layouts.navigation')
    </nav>

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-gradient-to-r from-blue-600 to-purple-600 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold text-white tracking-wide">
                    {{ $header }}
                </h1>
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="flex-grow max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 w-full">
        <div class="bg-white shadow-xl rounded-2xl p-6 transition hover:shadow-2xl">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-700 to-purple-700 text-white py-4 mt-auto shadow-inner">
        <div class="max-w-7xl mx-auto text-center text-sm">
            <p>© {{ date('Y') }} <span class="font-semibold">{{ config('app.name', 'Notes App') }}</span>. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
