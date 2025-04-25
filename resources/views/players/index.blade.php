<x-app-layout>
    <form method="GET" class="mb-8 flex flex-wrap justify-center items-end gap-6 bg-white shadow rounded-lg p-4">
        <div>
            <label for="club" class="block text-sm font-semibold mb-1">Klub:</label>
            <select name="club" id="club" class="form-select rounded-md border-gray-300">
                <option value="">Wszystkie</option>
                @foreach ($clubs as $club)
                    <option value="{{ $club }}" @selected(request('club') == $club)>{{ $club }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="position" class="block text-sm font-semibold mb-1">Pozycja:</label>
            <select name="position" id="position" class="form-select rounded-md border-gray-300">
                <option value="">Wszystkie</option>
                @foreach ($positions as $pos)
                    <option value="{{ $pos }}" @selected(request('position') == $pos)>{{ $pos }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="sort" class="block text-sm font-semibold mb-1">Sortowanie:</label>
            <select name="sort" id="sort" class="form-select rounded-md border-gray-300">
                <option value="">Domyślnie</option>
                <option value="rating" @selected(request('sort') == 'rating')>Średnia ocen</option>
                <option value="name" @selected(request('sort') == 'name')>Nazwy (A-Z)</option>
            </select>
        </div>
        <div>
            <label for="comment_search" class="block text-sm font-semibold mb-1">Szukaj w komentarzach:</label>
            <input type="text" name="comment_search" id="comment_search"
                value="{{ request('comment_search') }}"
                class="form-input rounded-md border-gray-300 w-64"
                placeholder="np. Talent, słaby, genialny...">
        </div>
        <div>
            <label for="name" class="block text-sm font-semibold mb-1">Szukaj po zawodniku:</label>
            <input type="text" name="name" id="name"
                value="{{ request('name') }}"
                class="form-input rounded-md border-gray-300 w-64"
                placeholder="np. Lewandowski, Messi...">
        </div>
        <div>
            <label for="birthplace" class="block text-sm font-semibold mb-1">Miejsce urodzenia:</label>
            <select name="birthplace" id="birthplace" class="form-select rounded-md border-gray-300">
                <option value="">Wszystkie</option>
                @foreach ($birthplaces as $bp)
                    <option value="{{ $bp }}" @selected(request('birthplace') == $bp)>{{ $bp }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-3 mt-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition shadow">
                🔍 Filtruj
            </button>

            <a href="{{ route('players.index') }}"
            class="bg-gray-200 hover:bg-red-400 hover:text-white text-gray-700 font-semibold px-4 py-2 rounded-md transition shadow inline-block">
                ✖ Wyczyść
            </a>
        </div>

    </form>
    
    <div class="max-w-4xl mx-auto px-4 pt-6 pb-8">
    <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold">📋 Lista zawodników</h2>

            @auth
                <a href="{{ route('players.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4v16m8-8H4"/>
                    </svg>
                    Dodaj zawodnika
                </a>
            @endauth
        </div>


        <div class="space-y-4">
            @foreach ($players as $player)
                    <div class="bg-white shadow rounded-lg p-4 flex items-start gap-4 hover:shadow-md transition">
            {{-- Zdjęcie po lewej --}}
            @if ($player->photo_path)
                    <img src="{{ asset('storage/' . $player->photo_path) }}"
            alt="Zdjęcie {{ $player->name }}"
            class="w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-lg shadow-md" />
            @else
                <div class="w-24 h-24 bg-gray-200 flex items-center justify-center rounded-lg text-sm text-gray-500">
                    Brak zdjęcia
                </div>
            @endif

            {{-- Dane zawodnika po prawej --}}
            <div>
                <h3 class="text-xl font-semibold text-blue-800">
                    <a href="{{ route('players.show', $player) }}" class="hover:underline">
                        {{ $player->name }}
                    </a>
                </h3>
                <p class="text-gray-700 mt-1">
                    ⚽ Klub: <strong>{{ $player->club }}</strong> |
                    🧍‍♂️ Pozycja: <strong>{{ $player->position }}</strong>
                </p>
                <p class="text-gray-700 mt-1">
                    ⭐ Średnia ocen: <strong>{{ $player->averageRating() }}</strong> |
                    💬 Komentarzy: <strong>{{ $player->ratings->count() }}</strong>
                </p>
            </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
