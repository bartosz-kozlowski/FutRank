<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">📧 Potwierdź swój e-mail</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
            Dziękujemy za rejestrację! Zanim zaczniesz, kliknij w link weryfikacyjny, który właśnie wysłaliśmy na Twój adres e-mail.
            <br>Nie otrzymałeś wiadomości? Możesz poprosić o nowy link poniżej.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-green-600 dark:text-green-400 text-sm text-center font-medium">
            ✅ Nowy link weryfikacyjny został wysłany na Twój adres e-mail.
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-6">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                🔁 Wyślij ponownie link
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="text-sm text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 underline transition">
                🚪 Wyloguj się
            </button>
        </form>
    </div>
</x-guest-layout>
