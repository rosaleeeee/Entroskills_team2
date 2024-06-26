<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function saveScore(Request $request)
    {
        $user = Auth::user();
        $user->score += $request->input('score');
        $user->save();

        return response()->json(['success' => true]);
    }
}

