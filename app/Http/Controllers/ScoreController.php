<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function saveScore(Request $request)
    {
        $user = Auth::user();
        $score = $request->input('score');
        
        // Mettre à jour le score de l'utilisateur
        $user->score += $score;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Score saved successfully!',
            'score' => $user->score
        ]);
    }
}
