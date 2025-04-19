<x-guest-layout>
    <div class="mb-6 text-center text-sm text-gray-700 dark:text-gray-300">
        🔐 To zabezpieczony obszar aplikacji. Potwierdź swoje hasło, aby kontynuować.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        @csrf

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="'Hasło'" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm button -->
        <div class="flex justify-end">
            <x-primary-button>
                ✅ Potwierdź
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
