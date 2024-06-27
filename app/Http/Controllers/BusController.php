<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessModel;
use App\Models\User;
use Auth;
use App\Jobs\SendMessage;
use App\Models\Message;
use Illuminate\Http\JsonResponse;

class BusController extends Controller
{
    

    public function store(Request $request)
    {
        $request->validate([
            'key_partnerships' => 'nullable|string',
            'key_activities' => 'nullable|string',
            'key_resources' => 'nullable|string',
            'value_propositions' => 'nullable|string',
            'customer_relationships' => 'nullable|string',
            'customer_segments' => 'nullable|string',
            'channels' => 'nullable|string',
            'cost_structure' => 'nullable|string',
            'revenue_streams' => 'nullable|string',
        ]);

        // Pour déboguer, afficher les données reçues du formulaire

        // Enregistrer les données du modèle d'affaires
        BusinessModel::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'key_partnerships' => $request->key_partnerships,
                'key_activities' => $request->key_activities,
                'key_resources' => $request->key_resources,
                'value_propositions' => $request->value_propositions,
                'customer_relationships' => $request->customer_relationships,
                'customer_segments' => $request->customer_segments,
                'channels' => $request->channels,
                'cost_structure' => $request->cost_structure,
                'revenue_streams' => $request->revenue_streams,
                'completed' => true,
            ]
        ); 

        return redirect()->route('business_model.wait');
    }

    public function result()
{
    $completedModels = BusinessModel::where('completed', true)->count();

    // Vérifier si tous les utilisateurs ont complété le modèle d'affaires
    if ($completedModels >= 9) {
        $businessModels = BusinessModel::all();
        return view('level2.result', compact('businessModels')); // Nom de la vue corrigé
    } else {
        // Rediriger ou afficher un message d'erreur selon votre besoin
        return redirect()->route('business_model.create')->with('error', 'Vous ne pouvez pas accéder aux résultats tant que tous les utilisateurs n\'ont pas rempli le Business Model Canvas.');
    }
}
public function wait()
{
    return view('level2.wait');
}
public function checkCompletion()
{
    $completedModels = BusinessModel::where('completed', true)->count();

    return response()->json([
        'allCompleted' => $completedModels >= completedModels
    ]);
}





public function __construct() {
    $this->middleware('auth');
}

public function create() {
    $user = User::where('id', auth()->id())->select([
        'id', 'name', 'email',
    ])->first();

    return view('level2.use_case', [
        'user' => $user,
    ]);
}

public function messages(): JsonResponse {
    $messages = Message::with('user')->get()->append('time');

    return response()->json($messages);
}

public function message(Request $request): JsonResponse {
    $message = Message::create([
        'user_id' => auth()->id(),
        'text' => $request->get('text'),
    ]);
    SendMessage::dispatch($message);

    return response()->json([
        'success' => true,
        'message' => "Message created and job dispatched.",
    ]);
}





}
