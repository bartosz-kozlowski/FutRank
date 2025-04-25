<x-app-layout>
    <div class="max-w-xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6">➕ Dodaj nowego zawodnika</h2>

        <form method="POST" action="{{ route('players.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <x-input-label for="name" value="Imię i nazwisko" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="club" value="Klub" />
                <x-text-input id="club" name="club" type="text" class="mt-1 block w-full" value="{{ old('club') }}" required />
                <x-input-error :messages="$errors->get('club')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="position" value="Pozycja" />
                <select name="position" id="position" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Wybierz pozycję</option>
                    <option value="bramkarz" {{ old('position') == 'bramkarz' ? 'selected' : '' }}>Bramkarz</option>
                    <option value="obrońca" {{ old('position') == 'obrońca' ? 'selected' : '' }}>Obrońca</option>
                    <option value="pomocnik" {{ old('position') == 'pomocnik' ? 'selected' : '' }}>Pomocnik</option>
                    <option value="napastnik" {{ old('position') == 'napastnik' ? 'selected' : '' }}>Napastnik</option>
                </select>
                <x-input-error :messages="$errors->get('position')" class="mt-2" />
            </div>

            <x-input-label for="birthplace" value="Miejsce urodzenia (opcjonalnie)" class="mt-4" />
            <x-text-input id="birthplace" name="birthplace" type="text" class="mt-1 block w-full"
                        value="{{ old('birthplace', $player->birthplace ?? '') }}" />


            <div class="mb-4">
                <x-input-label for="photo" value="Zdjęcie zawodnika (opcjonalnie)" />
                <div class="max-w-sm overflow-hidden text-ellipsis whitespace-nowrap">
                    <input type="file" name="photo" class="block mt-1 w-full file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200" />
                </div>
                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
            </div>

            <x-primary-button class="w-full justify-center mt-4">
                💾 Zapisz zawodnika
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
