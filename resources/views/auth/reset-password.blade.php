<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">🔐 Zresetuj hasło</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1 text-sm">
            Wprowadź nowy e-mail i hasło, aby ustawić nowe dane logowania.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="'Adres e-mail'" />
            <x-text-input id="email" name="email" type="email"
                          class="mt-1 block w-full"
                          :value="old('email', $request->email)"
                          required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- New password -->
        <div>
            <x-input-label for="password" :value="'Nowe hasło'" />
            <x-text-input id="password" name="password" type="password"
                          class="mt-1 block w-full"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm password -->
        <div>
            <x-input-label for="password_confirmation" :value="'Powtórz hasło'" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                          class="mt-1 block w-full"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <!-- Submit -->
        <div class="flex justify-end pt-2">
            <x-primary-button>
                🔁 Zresetuj hasło
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
