<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'NH HIGH SCHOOL')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.6/dist/cdn.min.js"></script>
    {{-- @livewireStyles --}}
</head>
<body class="relative flex min-h-screen flex-col bg-gray-50 py-6 sm:py-12">
    <!-- Background Grid -->
    <div class="absolute inset-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" class="opacity-10">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="gray" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />
        </svg>
    </div>

    <!-- Header -->
    <header class="relative z-10">
        @include('components.navbar')
    </header>

    <!-- Main Content -->
    <main class="relative z-10 pt-10">
        <div class="mx-auto">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 mt-12">
        @include('components.footer')
    </footer>

    {{-- @livewireScripts --}}
</body>
</html>
