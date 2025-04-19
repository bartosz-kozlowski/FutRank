<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            🗑️ Usuń konto
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Po usunięciu konta wszystkie Twoje dane i zasoby zostaną trwale usunięte. Przed kontynuacją upewnij się, że zapisałeś wszelkie informacje, które chcesz zachować.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >🗑️ Usuń konto</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Czy na pewno chcesz usunąć konto?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Po usunięciu konta wszystkie dane zostaną trwale usunięte. Aby potwierdzić, wpisz swoje hasło.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Hasło" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Wpisz hasło"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Anuluj
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Usuń konto
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
