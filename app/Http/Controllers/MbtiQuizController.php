<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MbtiDetail;

class MbtiQuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private $questions = [
        "At a party, do you:" => [
            "Talk to many people, including those you don't know" => "E",
            "Stick to a few familiar faces" => "I"
        ],
        "Are you more:" => [
            "Practical than theoretical" => "S",
            "Theoretical than practical" => "N"
        ],
        "Is it worse to:" => [
            "Be out of touch with reality" => "S",
            "Be stuck in a mundane routine" => "N"
        ],
        "Are you more impressed by:" => [
            "Logic" => "T",
            "Feelings" => "F"
        ],
        "Are you more drawn to:" => [
            "Rational arguments" => "T",
            "Emotional appeals" => "F"
        ],
        "Do you prefer to work:" => [
            "With set deadlines" => "J",
            "At your own pace" => "P"
        ],
        "Do you make decisions:" => [
            "Carefully" => "J",
            "Spontaneously" => "P"
        ],
        "At gatherings, do you:" => [
            "Stay late, enjoying yourself more and more" => "E",
            "Leave early, feeling worn out" => "I"
        ],
        "Are you more attracted to:" => [
            "Practical people" => "S",
            "Imaginative people" => "N"
        ],
        "Are you more interested in:" => [
            "What is real" => "S",
            "What is possible" => "N"
        ],
        "When evaluating others, do you focus more on:" => [
            "Rules than exceptions" => "T",
            "Exceptions than rules" => "F"
        ],
        "When approaching others, do you tend to be:" => [
            "Objective" => "T",
            "Personal" => "F"
        ],
        "Does it bother you more to have things:" => [
            "Incomplete" => "J",
            "Finished" => "P"
        ],
        "In social settings, do you:" => [
            "Stay updated on others' lives" => "E",
            "Lose track of what’s going on with others" => "I"
        ],
        "When doing routine tasks, do you:" => [
            "Follow traditional methods" => "S",
            "Try new methods" => "N"
        ],
        "Writers should:" => [
            "Say exactly what they mean" => "S",
            "Use metaphors and analogies" => "N"
        ],
        "Which appeals to you more:" => [
            "Consistency in thought" => "T",
            "Harmonious relationships" => "F"
        ],
        "Do you want things to be:" => [
            "Decided" => "J",
            "Open-ended" => "P"
        ],
        "Would you describe yourself as more:" => [
            "Serious and determined" => "J",
            "Relaxed and easy-going" => "P"
        ],
        "When making phone calls, do you:" => [
            "Not worry about saying everything correctly" => "E",
            "Rehearse what you’re going to say" => "I"
        ],
        "Facts:" => [
            "Speak for themselves" => "S",
            "Serve to illustrate principles" => "N"
        ],
        "Are you more often:" => [
            "Logical and cool-headed" => "T",
            "Warm and empathetic" => "F"
        ],
        "Is it worse to be:" => [
            "Unfair" => "T",
            "Unkind" => "F"
        ],
        "Do you feel better about:" => [
            "Making purchases" => "J",
            "Keeping your options open" => "P"
        ],
        "In social situations, do you:" => [
            "Start conversations" => "E",
            "Wait for others to initiate" => "I"
        ],
        "When making decisions, do you rely more on:" => [
            "Standards" => "T",
            "Emotions" => "F"
        ],
        "Do you value being:" => [
            "Consistent" => "J",
            "Open to new experiences" => "P"
        ],
        "Does meeting new people:" => [
            "Energize you" => "E",
            "Exhaust you" => "I"
        ],
        "Are you more likely to:" => [
            "See how others can be useful" => "S",
            "Understand others' perspectives" => "N"
        ],
        "Do you look for:" => [
            "Order" => "J",
            "Spontaneity" => "P"
        ],
    ];

    public function showStart()
    {
        return view('level4.quiz.newmbti', ['questions' => array_slice($this->questions, 0, 10)]);
    }

    public function submitStart(Request $request)
    {
        $data = $request->all();

        // Calcul des résultats de la première partie
        $startResults = [
            'E' => 0,
            'I' => 0,
            'S' => 0,
            'N' => 0,
            'T' => 0,
            'F' => 0,
            'J' => 0,
            'P' => 0,
        ];

        foreach (array_slice($this->questions, 0, 10) as $question => $answers) {
            $key = str_replace(' ', '_', strtolower($question));
            if (isset($data[$key])) {
                $startResults[$data[$key]]++;
            } else {
                return redirect()->back()->withErrors(['message' => 'Please answer all the questions.']);
            }
        }

        // Enregistrement des résultats de la première partie dans la base de données
        $user = Auth::user();
        $mbtiDetail = MbtiDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'E_start' => $startResults['E'],
                'I_start' => $startResults['I'],
                'S_start' => $startResults['S'],
                'N_start' => $startResults['N'],
                'T_start' => $startResults['T'],
                'F_start' => $startResults['F'],
                'J_start' => $startResults['J'],
                'P_start' => $startResults['P'],
            ]
        );

        // Redirection vers le tableau de bord
        return redirect()->route('dashboard');
    }

    public function show()
    {
        return view('level4.quiz.show', ['questions' => array_slice($this->questions, 10)]);
    }

    public function submit(Request $request)
    {
        $data = $request->all();
        $level4Results = [
            'E' => 0,
            'I' => 0,
            'S' => 0,
            'N' => 0,
            'T' => 0,
            'F' => 0,
            'J' => 0,
            'P' => 0,
        ];

        foreach (array_slice($this->questions, 10) as $question => $answers) {
            $key = str_replace(' ', '_', strtolower($question));
            if (isset($data[$key])) {
                $level4Results[$data[$key]]++;
            } else {
                return redirect()->back()->withErrors(['message' => 'Please answer all the questions.']);
            }
        }

        $user = Auth::user();
        $mbtiDetail = MbtiDetail::where('user_id', $user->id)->first();

        $totalResults = [
            'E' => $mbtiDetail->E_start + $level4Results['E'],
            'I' => $mbtiDetail->I_start + $level4Results['I'],
            'S' => $mbtiDetail->S_start + $level4Results['S'],
            'N' => $mbtiDetail->N_start + $level4Results['N'],
            'T' => $mbtiDetail->T_start + $level4Results['T'],
            'F' => $mbtiDetail->F_start + $level4Results['F'],
            'J' => $mbtiDetail->J_start + $level4Results['J'],
            'P' => $mbtiDetail->P_start + $level4Results['P'],
        ];

        $mbti_type = '';
        $mbti_type .= $totalResults['E'] >= $totalResults['I'] ? 'E' : 'I';
        $mbti_type .= $totalResults['N'] >= $totalResults['S'] ? 'N' : 'S';
        $mbti_type .= $totalResults['F'] >= $totalResults['T'] ? 'F' : 'T';
        $mbti_type .= $totalResults['P'] >= $totalResults['J'] ? 'P' : 'J';

        $user->mbti_type = $mbti_type;
        $user->save();

        $mbtiDetail->update([
            'E_level4' => $level4Results['E'],
            'I_level4' => $level4Results['I'],
            'S_level4' => $level4Results['S'],
            'N_level4' => $level4Results['N'],
            'T_level4' => $level4Results['T'],
            'F_level4' => $level4Results['F'],
            'J_level4' => $level4Results['J'],
            'P_level4' => $level4Results['P'],
        ]);

        return redirect()->route('quiz.result', [
            'mbti_type' => $mbti_type,
            'totalResults' => $totalResults
        ]);
    }

    public function result(Request $request)
    {
        $user = Auth::user();

        // Récupérer le type MBTI et les résultats de la requête
        $mbti_type = $request->input('mbti_type');
        $totalResults = $request->input('totalResults');

        // Extraire chaque résultat individuellement
        $results_E = $totalResults['E'];
        $results_I = $totalResults['I'];
        $results_S = $totalResults['S'];
        $results_N = $totalResults['N'];
        $results_T = $totalResults['T'];
        $results_F = $totalResults['F'];
        $results_J = $totalResults['J'];
        $results_P = $totalResults['P'];

        return view('level4.quiz.result', compact('user', 'mbti_type', 'results_E', 'results_I', 'results_S', 'results_N', 'results_T', 'results_F', 'results_J', 'results_P'));
    }
}
