<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPosition;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AffectMbtiController extends Controller
{ 
    public function index()
    {
        $users = User::take(9)->get();
        
        $positions = [
            'Product Manager',
            'Marketing Manager',
            'Sales Manager',
            'Customer Service Manager',
            'Chief Financial Officer (CFO)',
            'Chief Operating Officer (COO)',
            'Project Manager',
            'Partnerships Manager',
            'Accountant'
        ];

        return view('level4.quiz.affect_mbti', compact('users', 'positions'));
    }

    public function updateJobs(Request $request)
    {
        $request->validate([
            'positions' => 'required|array',
            'positions.*.userId' => 'required|exists:users,id',
            'positions.*.job' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->positions as $position) {
                $user = User::find($position['userId']);
                if ($user) {
                    $user->job = $position['job'];
                    $user->save();
                }
            }
        });

        return response()->json(['message' => 'Jobs mis à jour avec succès']);
    }

    public function updateTemporaryJobs(Request $request)
    {
        $validatedData = $request->validate([
            'positions' => 'required|array',
            'positions.*.userId' => 'required|exists:users,id',
            'positions.*.job' => 'required|string|max:255'
        ]);

        try {
            DB::transaction(function () use ($validatedData) {
                foreach ($validatedData['positions'] as $position) {
                    UserPosition::create([
                        'user_id' => $position['userId'],
                        'position' => $position['job']
                    ]);
                }
            });
        } catch (\Exception $e) {
            Log::error('Error updating temporary jobs: ' . $e->getMessage());
            return response()->json(['message' => 'Error occurred while updating the temporary assignments.'], 500);
        }

        return response()->json(['message' => 'Affectations temporaires mises à jour']);
    }

    public function finalizeJobs()
    {
        try {
            DB::transaction(function () {
                $userPositions = UserPosition::all();
                $positionCounts = [];

                foreach ($userPositions as $userPosition) {
                    $userId = $userPosition->user_id;
                    $position = $userPosition->position;

                    if (!isset($positionCounts[$userId])) {
                        $positionCounts[$userId] = [];
                    }

                    if (!isset($positionCounts[$userId][$position])) {
                        $positionCounts[$userId][$position] = 0;
                    }

                    $positionCounts[$userId][$position]++;
                }

                $assignedPositions = [];
                $assignedUsers = [];
                while (count($assignedUsers) < count($positionCounts)) {
                    foreach ($positionCounts as $userId => $positions) {
                        arsort($positions);

                        foreach ($positions as $position => $count) {
                            if (!in_array($position, $assignedPositions)) {
                                $user = User::find($userId);
                                if ($user) {
                                    $user->job = $position;
                                    $user->save();

                                    $assignedUsers[] = $userId;
                                    $assignedPositions[] = $position;
                                }
                                break;
                            }
                        }
                    }
                }

                // Supprimer toutes les affectations temporaires après finalisation
                //UserPosition::truncate();
            });
        } catch (\Exception $e) {
            Log::error('Error finalizing jobs: ' . $e->getMessage());
            return response()->json(['message' => 'Error occurred while finalizing the jobs.'], 500);
        }

        return response()->json(['message' => 'Les emplois ont été finalisés avec succès']);
    }

    public function checkAllUsersCompleted()
    {
        $positionCount = UserPosition::count();

        return response()->json([
            'allCompleted' => $positionCount >= 81
        ]);
    }
}
