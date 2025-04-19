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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
            <footer class="bg-gray-900 text-white py-6 mt-0 shadow-inner">
                <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm">
                    <div class="flex items-center gap-2">
                        <span>⚽</span>
                        <span class="font-semibold">FutRank</span>
                        <span class="text-gray-400">© {{ now()->year }}</span>
                        <span class="font-semibold">Bartosz Kozłowski</span>
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ route('players.index') }}" class="hover:text-blue-400 transition">Lista zawodników</a>
                        <a href="{{ route('players.ranking') }}" class="hover:text-blue-400 transition">Ranking</a>
                        @auth
                            <a href="{{ route('profile.edit') }}" class="hover:text-blue-400 transition">Profil</a>
                        @endauth
                    </div>
                </div>
            </footer>

    </body>
</html>
