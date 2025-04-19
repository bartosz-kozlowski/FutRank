<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Player;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Pobieramy zawodników z relacjami + sort/filtrowanie
        $query = Player::with('ratings');

        // 🔍 Filtrowanie po klubie
        if ($request->filled('club')) {
            $query->where('club', $request->club);
        }

        // 🔍 Filtrowanie po pozycji
        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        // 🔍 Filtrowanie po miejscu urodzenia
        if ($request->filled('birthplace')) {
            $query->where('birthplace', $request->birthplace);
        }

        // 🔃 Sortowanie
        if ($request->sort === 'rating') {
            $query->withAvg('ratings', 'rating')->orderByDesc('ratings_avg_rating');
        } elseif ($request->sort === 'name') {
            $query->orderBy('name');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // 💾 Pobieramy graczy z bazy
        $players = $query->get();

        // 🗣️ Wyszukiwanie komentarzy
        if ($search = $request->input('comment_search')) {
            $players = $players->filter(function ($player) use ($search) {
                return $player->ratings->contains(function ($rating) use ($search) {
                    return str_contains(strtolower($rating->comment), strtolower($search));
                });
            });
        }

        // 🔢 Dane pomocnicze do formularza
        $clubs = Player::select('club')->distinct()->pluck('club');
        $positions = Player::select('position')->distinct()->pluck('position');
        $birthplaces = Player::select('birthplace')->whereNotNull('birthplace')->distinct()->pluck('birthplace');

        return view('players.index', compact('players', 'clubs', 'positions', 'birthplaces'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('players.create');
        //dd('create działa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'club' => 'required|string|max:255',
            'position' => 'required|string|max:50',
            'birthplace' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048'
        ]);
    
        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('players', 'public');
        }
    
        Player::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'club' => $validated['club'],
            'position' => $validated['position'],
            'birthplace' => $validated['birthplace'],
            'photo_path' => $path,
        ]);
    
        return redirect()->route('players.index')->with('message', 'Zawodnik dodany!');
    }

    public function ranking()
    {
        $players = Player::with('ratings')
            ->get()
            ->sortByDesc(fn($player) => $player->averageRating())
            ->values()
            ->take(5);

        return view('players.ranking', compact('players'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $player = \App\Models\Player::with('ratings.user')->findOrFail($id);
        return view('players.show', compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $player = \App\Models\Player::findOrFail($id);

        // sprawdź, czy obecny użytkownik jest właścicielem
        if ($player->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        return view('players.edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $player = Player::findOrFail($id);

        if ($player->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'club' => 'required|string|max:255',
            'position' => 'required|string|max:50',
            'birthplace' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('players', 'public');
            $player->photo_path = $path;
        }

        $player->update([
            'name' => $validated['name'],
            'club' => $validated['club'],
            'position' => $validated['position'],
            'birthplace' => $validated['birthplace'],
            'photo_path' => $player->photo_path, // jeśli nie zmieniono, zostaje stare
        ]);

        return redirect()->route('players.show', $player)->with('message', 'Zawodnik zaktualizowany!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $player = Player::findOrFail($id);

        // Tylko jeśli to jego twórca
        if ($player->user_id !== auth()->id()) {
            abort(403, 'Nie masz uprawnień do usunięcia tego zawodnika.');
        }

        // Usuwamy powiązane oceny (opcjonalnie)
        $player->ratings()->delete();

        // Usuwamy zdjęcie (jeśli istnieje)
        if ($player->photo_path) {
            \Storage::disk('public')->delete($player->photo_path);
        }

        $player->delete();

        return redirect()->route('players.index')->with('message', 'Zawodnik został usunięty.');
    }

}
