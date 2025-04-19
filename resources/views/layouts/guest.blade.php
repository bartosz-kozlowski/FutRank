<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>⚽ FutRank</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">

    <div class="min-h-screen flex flex-col justify-center items-center px-4">
        {{-- Logo + nazwa aplikacji --}}
        <div class="text-center mb-2">
            <a href="/" class="flex flex-col items-center gap-2">
                <img src="{{ asset('images/this.png') }}" alt="Logo FutRank" class="w-12 h-12 rounded-full shadow-md">
                <h1 class="text-xl font-bold text-blue-600">FutRank – oceń zawodnika!</h1>
            </a>
        </div>

        {{ $slot }}
    </div>

</body>
</html>
