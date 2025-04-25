<x-app-layout>
    <form method="GET" action="{{ route('players.ranking') }}" class="mb-4 bg-white shadow rounded-lg p-4">
        <div class="flex items-center gap-4 justify-center flex-wrap">
            <label for="limit" class="text-sm font-medium text-gray-700 whitespace-nowrap">
                Pokaż TOP:
            </label>
            <select name="limit" id="limit" onchange="this.form.submit()"
                    class="rounded-md border border-gray-300 px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring focus:ring-indigo-300 min-w-[4rem]">
                @foreach ([3, 5, 10, 20] as $value)
                    <option value="{{ $value }}" {{ request('limit', 5) == $value ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
    <div class="max-w-4xl mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold mb-6">🏆 Ranking zawodników</h2>
        <h3 class="text-2xl font-bold mb-6">Sprawdź ulubieńców portalu FutRank!</h2>
        @forelse ($players as $index => $player)
        <div class="flex items-start gap-4 bg-white p-4 mb-3 rounded shadow">
            <div class="text-2xl font-bold text-gray-700 w-8 text-right mt-2">{{ $index + 1 }}.</div>

            @if ($player->photo_path)
                <img src="{{ asset('storage/' . $player->photo_path) }}"
                    alt="{{ $player->name }}"
                    class="w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-lg shadow-md">
            @endif

            <div class="flex flex-col justify-start">
                <a href="{{ route('players.show', ['player' => $player->id, 'from' => 'ranking']) }}"
                class="text-xl font-semibold text-blue-800 hover:underline">
                    {{ $player->name }}
                </a>
                <p class="text-gray-700 mt-1">⚽ {{ $player->club }} | 🧍 {{ $player->position }}</p>
                <p class="text-gray-700 mt-1">⭐ Średnia ocen: <strong>{{ $player->averageRating() }}</strong></p>
            </div>
        </div>
        @empty
            <p>Brak zawodników do wyświetlenia w rankingu.</p>
        @endforelse

    </div>
</x-app-layout>
