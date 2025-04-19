<!-- resources/views/components/login-modal.blade.php -->
<div x-data="{ open: false }" @keydown.escape.window="open = false">
    <!-- Przycisk otwierający modal -->
    <button @click="open = true"
        class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded shadow">
        🔐 Zaloguj się
    </button>

    <!-- Modal -->
    <div x-show="open"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
         style="display: none;"
         x-transition>
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
            <!-- Zamknij -->
            <button @click="open = false"
                    class="absolute top-2 right-3 text-gray-500 hover:text-gray-800">
                ✖
            </button>

            <!-- Formularz logowania -->
            <h2 class="text-2xl font-bold text-center mb-4">🔐 Logowanie</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Adres e-mail</label>
                    <input type="email" name="email" id="email" required
                           class="mt-1 w-full border-gray-300 rounded-md shadow-sm" />
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Hasło</label>
                    <input type="password" name="password" id="password" required
                           class="mt-1 w-full border-gray-300 rounded-md shadow-sm" />
                </div>

                <div class="flex justify-between items-center mb-4">
                    <label class="flex items-center text-sm">
                        <input type="checkbox" name="remember" class="mr-2">
                        Zapamiętaj mnie
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Przypomnij hasło</a>
                    @endif
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded shadow">
                    Zaloguj się
                </button>
            </form>
        </div>
    </div>
</div>
