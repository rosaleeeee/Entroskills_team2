<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessModelController extends Controller
{
    public function checkAnswers(Request $request)
    {
        $correctAnswers = [
            "cell1" => "Value Propositions",
            "cell2" => "Customer Segments",
            "cell3" => "Channels",
            "cell4" => "Customer Relationships",
            "cell5" => "Revenue Streams",
            "cell6" => "Key Resources",
            "cell7" => "Key Activities",
            "cell8" => "Key Partnerships",
            "cell9" => "Cost Structure"
        ];

        public function Score($id)
        {
            $user = Auth::user();
       
        $userAnswers = $request->input('userAnswers');
        $attempts = $request->input('attempts');
       

        $correctCount = 0;
        foreach ($correctAnswers as $cellId => $correctAnswer) {
            if (isset($userAnswers[$cellId]) && $userAnswers[$cellId] === $correctAnswer) {
                $correctCount++;
            }
        }


        if ($correctCount === count($correctAnswers)) {
            if ($attempts === 1) {
                $user->score += 5;
            } elseif ($attempts === 2) {
                $user->score += 3;
            } elseif ($attempts === 3) {
                $user->score += 1;
            }
        } else {
            if ($attempts >= 4) {
                $user->score -= 1; // Score de pénalité pour plus de 3 tentatives
            }
        }
      
       


        return response()->json([
            'allCorrect' => $correctCount === count($correctAnswers),
            'message' => $correctCount === count($correctAnswers) 
                        ? "Congratulations! All answers are correct. Score: {$scoreToAdd} Points."
                        : "Some answers are incorrect. Correct Answers: {$correctCount} / " . count($correctAnswers),
            'attempts' => $attempts,
            'score' => $user->score
        ]);
    }
}
}

