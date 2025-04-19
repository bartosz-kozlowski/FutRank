<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            🔒 Zmień hasło
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Dla bezpieczeństwa konta używaj długiego i trudnego do odgadnięcia hasła.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Obecne hasło -->
        <div>
            <x-input-label for="update_password_current_password" value="Obecne hasło" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- Nowe hasło -->
        <div>
            <x-input-label for="update_password_password" value="Nowe hasło" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Potwierdzenie hasła -->
        <div>
            <x-input-label for="update_password_password_confirmation" value="Potwierdź hasło" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Zapisz -->
        <div class="flex items-center gap-4">
            <x-primary-button>Zapisz zmiany</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400"
                >
                    ✅ Zapisano.
                </p>
            @endif
        </div>
    </form>
</section>
