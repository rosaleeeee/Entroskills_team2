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

    private 
    $questions = [
        // 1
        "At a party, do you:" => [
            "Talk to many people, including those you don't know" => "E",
            "Stick to a few familiar faces" => "I"
        ],
        // 2
        "Are you more:" => [
            "Practical than theoretical" => "S",
            "Theoretical than practical" => "N"
        ],
        // 3
        "Is it worse to:" => [
            "Be out of touch with reality" => "S",
            "Be stuck in a mundane routine" => "N"
        ],
        // 4
        "Are you more impressed by:" => [
            "Logic" => "T",
            "Feelings" => "F"
        ],
        // 5
        "Are you more drawn to:" => [
            "Rational arguments" => "T",
            "Emotional appeals" => "F"
        ],
        // 6
        "Do you prefer to work:" => [
            "With set deadlines" => "J",
            "At your own pace" => "P"
        ],
        // 7
        "Do you make decisions:" => [
            "Carefully" => "J",
            "Spontaneously" => "P"
        ],
        // 8
        "At gatherings, do you:" => [
            "Stay late, enjoying yourself more and more" => "E",
            "Leave early, feeling worn out" => "I"
        ],
        // 9
        "Are you more attracted to:" => [
            "Practical people" => "S",
            "Imaginative people" => "N"
        ],
        // 10
        "Are you more interested in:" => [
            "What is real" => "S",
            "What is possible" => "N"
        ],
        // 11
        "When evaluating others, do you focus more on:" => [
            "Rules than exceptions" => "T",
            "Exceptions than rules" => "F"
        ],
        // 12
        "When approaching others, do you tend to be:" => [
            "Objective" => "T",
            "Personal" => "F"
        ],
        // 13
        "Does it bother you more to have things:" => [
            "Incomplete" => "J",
            "Finished" => "P"
        ],
        // 14
        "In social settings, do you:" => [
            "Stay updated on others' lives" => "E",
            "Lose track of what’s going on with others" => "I"
        ],
        // 15
        "When doing routine tasks, do you:" => [
            "Follow traditional methods" => "S",
            "Try new methods" => "N"
        ],
        // 16
        "Writers should:" => [
            "Say exactly what they mean" => "S",
            "Use metaphors and analogies" => "N"
        ],
        // 17
        "Which appeals to you more:" => [
            "Consistency in thought" => "T",
            "Harmonious relationships" => "F"
        ],
        // 18
        "Are you more comfortable making:" => [
            "Logical decisions" => "T",
            "Value-based decisions" => "F"
        ],
        // 19
        "Do you want things to be:" => [
            "Decided" => "J",
            "Open-ended" => "P"
        ],
        // 20
        "Would you describe yourself as more:" => [
            "Serious and determined" => "J",
            "Relaxed and easy-going" => "P"
        ],
        // 21
        "When making phone calls, do you:" => [
            "Not worry about saying everything correctly" => "E",
            "Rehearse what you’re going to say" => "I"
        ],
        // 22
        "Facts:" => [
            "Speak for themselves" => "S",
            "Serve to illustrate principles" => "N"
        ],
        // 23
        "Are visionaries:" => [
            "Annoying" => "S",
            "Intriguing" => "N"
        ],
        // 24
        "Are you more often:" => [
            "Logical and cool-headed" => "T",
            "Warm and empathetic" => "F"
        ],
        // 25
        "Is it worse to be:" => [
            "Unfair" => "T",
            "Unkind" => "F"
        ],
        // 26
        "Should events unfold:" => [
            "By careful planning" => "J",
            "Naturally" => "P"
        ],
        // 27
        "Do you feel better about:" => [
            "Making purchases" => "J",
            "Keeping your options open" => "P"
        ],
        // 28
        "In social situations, do you:" => [
            "Start conversations" => "E",
            "Wait for others to initiate" => "I"
        ],
        // 29
        "Common sense is:" => [
            "Seldom questioned" => "S",
            "Often questioned" => "N"
        ],
        // 30
        "Children should:" => [
            "Be more useful" => "S",
            "Use their imagination more" => "N"
        ],
        // 31
        "When making decisions, do you rely more on:" => [
            "Standards" => "T",
            "Emotions" => "F"
        ],
        // 32
        "Which is more admirable:" => [
            "Being organized and methodical" => "J",
            "Being adaptable and resourceful" => "P"
        ],
        // 33
        "Do you value being:" => [
            "Consistent" => "J",
            "Open to new experiences" => "P"
        ],
        // 34
        "Does meeting new people:" => [
            "Energize you" => "E",
            "Exhaust you" => "I"
        ],
        // 35
        "Are you more frequently:" => [
            "Practical" => "S",
            "Imaginative" => "N"
        ],
        // 36
        "Are you more likely to:" => [
            "See how others can be useful" => "S",
            "Understand others' perspectives" => "N"
        ],
        // 37
        "Which is more satisfying:" => [
            "Thoroughly discussing an issue" => "T",
            "Reaching a consensus" => "F"
        ],
        // 38
        "Which governs you more:" => [
            "Your mind" => "T",
            "Your heart" => "F"
        ],
        // 39
        "Are you more comfortable with work that is:" => [
            "Structured" => "J",
            "Flexible" => "P"
        ],
        // 40
        "Do you look for:" => [
            "Order" => "J",
            "Spontaneity" => "P"
        ],
        // 41
        "Do you prefer:" => [
            "Many acquaintances" => "E",
            "A few close friends" => "I"
        ],
        // 42
        "Do you rely more on:" => [
            "Facts" => "S",
            "Theories" => "N"
        ],
        // 43
        "Are you more interested in:" => [
            "Production and efficiency" => "S",
            "Design and innovation" => "N"
        ],
        // 44
        "Which is a greater compliment:" => [
            "To be called logical" => "T",
            "To be called compassionate" => "F"
        ],
        // 45
        "Do you value more in yourself that you are:" => [
            "Decisive" => "J",
            "Devoted" => "P"
        ],
        // 46
        "Do you prefer:" => [
            "Definite statements" => "J",
            "Tentative statements" => "P"
        ],
        // 47
        "When faced with a challenge, do you:" => [
            "Take a logical approach" => "T",
            "Rely on your instincts" => "F"
        ],
        // 48
        "Do you feel more comfortable:" => [
            "Working in a planned manner" => "J",
            "Handling things as they come" => "P"
        ],
        // 49
        "When making plans, do you:" => [
            "Prefer clear guidelines" => "J",
            "Like to keep options open" => "P"
        ],
        // 50
        "Do you prefer to:" => [
            "Get to know many people" => "E",
            "Deepen relationships with a few" => "I"
        ]
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
        return redirect()->route('level1');
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
