<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-6">
            <a href="{{ route('players.index') }}"
        class="text-sm text-blue-600 hover:underline mb-4 inline-block">
            ← Powrót do listy zawodników
        </a>

        {{-- Nagłówek --}}
        <div class="flex items-center gap-6 bg-white rounded-lg shadow p-6">
            {{-- Zdjęcie --}}
            @if ($player->photo_path)
                <img src="{{ asset('storage/' . $player->photo_path) }}"
            alt="Zdjęcie {{ $player->name }}"
            class="w-32 h-32 sm:w-40 sm:h-40 object-cover rounded-full shadow" />
            @else
                <div class="w-32 h-32 bg-gray-200 flex items-center justify-center rounded-lg text-sm text-gray-500">
                    Brak zdjęcia
                </div>
            @endif

            {{-- Info o zawodniku --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $player->name }}</h1>
                <p class="text-gray-700 mt-1">🧍‍♂️ Pozycja: <strong>{{ $player->position }}</strong></p>
                <p class="text-gray-700">⚽ Klub: <strong>{{ $player->club }}</strong></p>
                <p class="text-gray-700">📍 Miejsce urodzenia: <strong>{{ $player->birthplace ?? 'Brak danych' }}</strong></p>
                <p class="mt-2 text-lg">⭐ Średnia ocen: <strong>{{ $player->averageRating() }}</strong></p>
                @auth
                @if ($player->user_id === Auth::id())
                    <div class="flex gap-3 mt-4">
                        <a href="{{ route('players.edit', $player) }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded shadow transition">
                            ✏️ Edytuj zawodnika
                        </a>

                        <form action="{{ route('players.destroy', $player) }}" method="POST"
                            onsubmit="return confirm('Czy na pewno chcesz usunąć zawodnika?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow transition">
                                🗑️ Usuń zawodnika
                            </button>
                        </form>
                    </div>
                @endif
                @endauth
            </div>
        </div>
 
        {{-- Formularz oceny --}}
        @auth
            @if (! $player->ratings->contains('user_id', Auth::id()))
                <div class="mt-6 bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold mb-2">📝 Oceń zawodnika:</h3>
                    <form method="POST" action="{{ route('ratings.store') }}">
                        @csrf
                        <input type="hidden" name="player_id" value="{{ $player->id }}">

                        <div class="mb-3">
                            <label for="rating">Ocena:</label>
                            <select name="rating" class="form-select w-24 rounded border-gray-300">
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comment">Komentarz (opcjonalny):</label>
                            <textarea name="comment" class="form-textarea w-full rounded border-gray-300" rows="2"></textarea>
                        </div>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                            ✅ Wyślij ocenę
                        </button>
                    </form>
                </div>
            @else
                <div class="mt-6 text-green-600 font-medium">✅ Już oceniłeś tego zawodnika.</div>
            @endif
        @endauth

        {{-- Komentarze --}}
        <div class="mt-8">
            <h3 class="text-xl font-bold mb-4">💬 Komentarze:</h3>

            @forelse ($player->ratings as $rating)
                <div class="bg-white p-4 mb-3 rounded shadow">
                    <p><strong>{{ $rating->user->name }}</strong> ocenił na <strong>{{ $rating->rating }}/5 ⭐</strong></p>
                    <p class="mt-1 text-gray-800">{{ $rating->comment }}</p>
                    <button onclick="analyzeComment({{ $rating->id }}, this)"
                            class="text-sm text-blue-600 underline hover:text-blue-800">
                        🧠 Analizuj komentarz AI
                    </button>

                    <div class="mt-1 text-sm text-gray-600 hidden" id="analysis-{{ $rating->id }}"></div>

                    @if ($rating->user_id === Auth::id())
                        <div class="mt-2 flex gap-2">
                            <a href="{{ route('ratings.edit', $rating) }}"
                               class="text-yellow-600 hover:underline">Edytuj</a>

                            <form action="{{ route('ratings.destroy', $rating) }}" method="POST"
                                  onsubmit="return confirm('Na pewno usunąć ocenę?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Usuń</button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-500">Brak komentarzy – bądź pierwszy!</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
<script>
    async function analyzeComment(ratingId, btn) {
        btn.disabled = true;
        btn.innerText = '⏳ Analizuję...';

        const res = await fetch("{{ route('comments.analyze') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ rating_id: ratingId })
        });

        const data = await res.json();
        document.getElementById('analysis-' + ratingId).innerText = 'AI: ' + data.result;
        document.getElementById('analysis-' + ratingId).classList.remove('hidden');
        btn.innerText = '🧠 Pokaż ponownie';
        btn.disabled = false;
    }
</script>
