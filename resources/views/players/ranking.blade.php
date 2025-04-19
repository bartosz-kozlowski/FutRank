<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold mb-6">🏆 Ranking zawodników</h2>

        @forelse ($players as $index => $player)
            <div class="flex items-center gap-4 bg-white p-4 mb-3 rounded shadow">
                <div class="text-2xl font-bold text-gray-700 w-8 text-right">{{ $index + 1 }}.</div>

                @if ($player->photo_path)
                    <img src="{{ asset('storage/' . $player->photo_path) }}"
                         alt="{{ $player->name }}"
                         class="w-16 h-16 object-cover rounded">
                @endif

                <div>
                    <h3 class="text-xl font-semibold text-blue-800">{{ $player->name }}</h3>
                    <p class="text-sm text-gray-600">⚽ {{ $player->club }} | 🧍 {{ $player->position }}</p>
                    <p class="text-sm">⭐ Średnia ocen: <strong>{{ $player->averageRating() }}</strong></p>
                </div>
            </div>
        @empty
            <p>Brak zawodników do wyświetlenia w rankingu.</p>
        @endforelse
    </div>
</x-app-layout>
