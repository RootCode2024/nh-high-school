<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'NH HIGH SCHOOL')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        @include('components.navbar')
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        @include('components.footer')
    </footer>
</body>
</html>
