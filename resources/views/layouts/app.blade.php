<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Sign in page using Tailwind CSS')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Welcomy')</title>

    <!-- Open Graph / Twitter -->
    <meta name="robots" content="follow, index">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@keenthemes">
    <meta name="twitter:creator" content="@keenthemes">
    <meta name="twitter:title" content="@yield('title', 'Welcomy')">
    <meta name="twitter:description" content="@yield('meta_description')">
    <meta name="twitter:image" content="{{ asset('assets/media/app/og-image.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Metronic">
    <meta property="og:title" content="@yield('title', 'Welcomy')">
    <meta property="og:description" content="@yield('meta_description')">
    <meta property="og:image" content="{{ asset('assets/media/app/og-image.png') }}">

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/app/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/media/app/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/media/app/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/media/app/favicon.ico') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vendor Styles -->
    <link href="{{ asset('assets/vendors/apexcharts/apexcharts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet">

    <!-- Metronic Styles -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <!-- Head -->
    @stack('styles')
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js" defer></script>>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col">

        {{-- Optional Header (Used for breadcrumbs, titles, etc.) --}}
        @hasSection('header')
            <header class="bg-white shadow mb-6">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        {{-- Page Content --}}
        <main class="flex-1">
            @yield('content')
        </main>

        {{-- Optional footer --}}
        <footer class="text-center text-xs text-gray-500 py-6">
            &copy; {{ date('Y') }} Welcomy. All rights reserved.
        </footer>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('assets/js/core.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
