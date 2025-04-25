<x-app-layout>
    <div class="max-w-xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">✏️ Edytuj swoją ocenę</h1>

        <div class="bg-white rounded-lg shadow p-6">
            <form method="POST" action="{{ route('ratings.update', $rating) }}">
                @csrf
                @method('PUT')

                {{-- Ocena liczbowo --}}
                <div class="mb-4">
                    <label for="rating" class="block text-sm font-semibold mb-1">Ocena (1–5):</label>
                    <select name="rating" id="rating" class="form-select w-24 border-gray-300 rounded">
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected($rating->rating == $i)>{{ $i }} ⭐</option>
                        @endfor
                    </select>
                </div>

                {{-- Komentarz --}}
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-semibold mb-1">Komentarz:</label>
                    <textarea name="comment" id="comment" rows="4"
                              class="form-textarea w-full border-gray-300 rounded"
                              placeholder="Napisz co sądzisz o zawodniku...">{{ old('comment', $rating->comment) }}</textarea>
                </div>

                {{-- Przycisk --}}
                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('players.show', $rating->player_id) }}"
                       class="text-gray-600 hover:underline">← Wróć do zawodnika</a>

                    <x-primary-button class="mt-6">
                    💾 Zapisz zmiany
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
