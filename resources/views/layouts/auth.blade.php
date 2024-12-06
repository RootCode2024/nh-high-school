<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Se Connecter</title>
    <link rel="shortcut icon" href="{{ asset('assets/logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- @livewireStyles --}}
</head>
<body>
    <main>
        @yield('content')
    </main>
    {{-- @livewireScripts --}}
</body>
</html>
