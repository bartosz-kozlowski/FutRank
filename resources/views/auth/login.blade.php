<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-md w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">🔐 Logowanie do FutRank</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Witaj ponownie! Zaloguj się, aby oceniać zawodników.</p>
            </div>

            <!-- Komunikaty -->
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600 dark:text-green-400 font-medium">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Formularz logowania -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adres e-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           class="mt-1 block w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-indigo-300 dark:focus:ring-indigo-600 focus:outline-none" />
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hasło -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hasło</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="mt-1 block w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-indigo-300 dark:focus:ring-indigo-600 focus:outline-none" />
                    @error('password')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Zapamiętaj mnie -->
                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600" />
                    <label for="remember_me" class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                        Zapamiętaj mnie
                    </label>
                </div>

                <!-- Przyciski -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                            🔑 Przypomnij hasło
                        </a>
                    @endif

                    <x-primary-button>
                        ✅ Zaloguj się
                    </x-primary-button>
                </div>

                <!-- Rejestracja -->
                @if (Route::has('register'))
                    <p class="text-sm text-center text-gray-600 dark:text-gray-400 mt-6">
                        Nie masz konta?
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Zarejestruj się</a>
                    </p>
                @endif
            </form>
        </div>
    </div>
</x-guest-layout>
