<x-guest-layout>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 mt-8 w-full">
        <h2 class="text-2xl font-bold text-center mb-4 text-blue-600">📧 Przypomnij hasło</h2>
        <p class="text-sm text-center text-gray-600 mb-6">
            Podaj swój adres e-mail, a wyślemy Ci link do zresetowania hasła.
        </p>

        <!-- Komunikat o statusie (np. wysłany link) -->
        <x-auth-session-status class="mb-4 text-sm text-green-600" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="'Adres e-mail'" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                              :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-primary-button class="w-full justify-center">
                    📤 Wyślij link do resetu hasła
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
