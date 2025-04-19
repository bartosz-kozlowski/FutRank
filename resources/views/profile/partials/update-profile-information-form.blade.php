<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            ✏️ Informacje o profilu
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Zaktualizuj swoje dane osobowe oraz adres e-mail powiązany z kontem.
        </p>
    </header>

    <!-- Formularz do ponownego wysłania weryfikacji -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Formularz aktualizacji profilu -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Imię i nazwisko -->
        <div>
            <x-input-label for="name" value="Imię i nazwisko" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                          :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- E-mail -->
        <div>
            <x-input-label for="email" value="Adres e-mail" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        Twój adres e-mail nie został jeszcze zweryfikowany.

                        <button form="send-verification" class="underline text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800">
                            Kliknij tutaj, aby ponownie wysłać wiadomość weryfikacyjną.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            Nowy link weryfikacyjny został wysłany na Twój adres e-mail.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Przycisk zapisu -->
        <div class="flex items-center gap-4">
            <x-primary-button>Zapisz zmiany</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400"
                >✅ Zapisano.</p>
            @endif
        </div>
    </form>
</section>
