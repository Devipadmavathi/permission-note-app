<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen flex flex-col">

    <!-- Navigation -->
    <div class="bg-white shadow-md sticky top-0 z-50">
        @include('layouts.navigation')
    </div>

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-gradient-to-r from-blue-600 to-purple-600 shadow text-white">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-semibold tracking-wide">
                    {{ $header }}
                </h1>
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="flex-grow max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 w-full">
        <div class="bg-white shadow-lg rounded-2xl p-6">
            @yield('content')
        </div>
    </main>

    <!-- Footer (sticks to bottom) -->
    <footer class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 mt-auto">
        <div class="max-w-7xl mx-auto text-center text-sm">
            © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </div>
    </footer>

</body>
</html>
