<x-app-layout>
    <div class="max-w-xl mx-auto mt-6 bg-white shadow p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">✏️ Edytuj zawodnika</h2>

        <form method="POST" action="{{ route('players.update', $player) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-input-label for="name" value="Imię i nazwisko" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $player->name }}" required />

            <x-input-label for="club" value="Klub" class="mt-4" />
            <x-text-input id="club" name="club" type="text" class="mt-1 block w-full" value="{{ $player->club }}" required />

            <x-input-label for="position" value="Pozycja" class="mt-4" />
            <select name="position" id="position" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @php
                    $positions = ['bramkarz', 'obrońca', 'pomocnik', 'napastnik'];
                @endphp

                @foreach ($positions as $pos)
                    <option value="{{ $pos }}" @selected($player->position === $pos)>
                        {{ ucfirst($pos) }}
                    </option>
                @endforeach
            </select>

            <x-input-label for="birthplace" value="Miejsce urodzenia (opcjonalnie)" class="mt-4" />
            <x-text-input id="birthplace" name="birthplace" type="text" class="mt-1 block w-full"
                        value="{{ old('birthplace', $player->birthplace ?? '') }}" />

            <x-input-label for="photo" value="Zdjęcie (opcjonalnie)" class="mt-4" />
            <div class="max-w-sm overflow-hidden text-ellipsis whitespace-nowrap">
                <input type="file" name="photo" class="block mt-1 w-full file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" />
            </div>

            @if ($player->photo_path)
                <p class="mt-2 text-sm text-gray-600">Aktualne zdjęcie:</p>
                <img src="{{ asset('storage/' . $player->photo_path) }}"
                    alt="Zdjęcie zawodnika"
                    class="w-32 h-32 object-cover rounded shadow mt-2" />
            @endif

            <x-primary-button class="mt-6">
                Zapisz zmiany
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
