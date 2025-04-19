<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Services\HuggingFaceService;

class CommentAnalysisController extends Controller
{
    public function analyze(Request $request, HuggingFaceService $hf)
    {
        $rating = Rating::findOrFail($request->input('rating_id'));
        $comment = $rating->comment;

        if (! $comment) {
            return response()->json(['result' => 'Brak komentarza do analizy']);
        }

        $result = $hf->analyzeSentiment($comment);

        return response()->json(['result' => $result]);
    }
}
