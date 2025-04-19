<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">
        <h2 class="text-3xl font-bold mb-6">👋 Witaj {{ Auth::user()->name }}!</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-2">📊 Twoje statystyki</h3>
                <ul class="list-disc ml-4 text-gray-700">
                    <li>Dodani zawodnicy: <strong>{{ Auth::user()->players->count() }}</strong></li>
                    <li>Wystawione oceny: <strong>{{ Auth::user()->ratings->count() }}</strong></li>
                </ul>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-2">⚽ Skróty</h3>
                <div class="flex flex-col gap-2 text-blue-700 font-semibold">
                    <a href="{{ route('players.index') }}" class="hover:underline">📋 Lista zawodników</a>
                    <a href="{{ route('players.create') }}" class="hover:underline">➕ Dodaj zawodnika</a>
                    <a href="{{ route('players.ranking') }}" class="hover:underline">🏆 Ranking zawodników</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
