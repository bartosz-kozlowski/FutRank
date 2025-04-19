<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'player_id' => 'required|exists:players,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        $existing = Rating::where('user_id', Auth::id())
                          ->where('player_id', $validated['player_id'])
                          ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Już oceniałeś tego zawodnika.');
        }

        Rating::create([
            'user_id' => Auth::id(),
            'player_id' => $validated['player_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('players.show', $validated['player_id'])->with('message', 'Dzięki za ocenę!');
    }
    public function edit(Rating $rating)
    {
        if ($rating->user_id !== Auth::id()) {
            abort(403);
        }

        return view('ratings.edit', compact('rating'));
    }

    public function update(Request $request, Rating $rating)
    {
        if ($rating->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        $rating->update($validated);

        return redirect()->route('players.show', $rating->player_id)->with('message', 'Ocena została zaktualizowana!');
    }

    public function destroy(Rating $rating)
    {
        if ($rating->user_id !== Auth::id()) {
            abort(403);
        }

        $rating->delete();

        return back()->with('message', 'Ocena została usunięta.');
    }
}
