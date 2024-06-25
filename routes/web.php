<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MbtiQuizController;
use App\Http\Controllers\MBTIPDFController;
use App\Http\Controllers\AllMbtiController;
use App\Http\Controllers\AffectMbtiController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RecController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\BusinessModelController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ScoreController;





use App\Models\User;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/level1/start-level1', function () {
    return view('level1.start-level1');
})->middleware(['auth', 'verified'])->name('start-level1');

Route::get('/level2/start-level2', function () {
    return view('level2.start-level2');
})->middleware(['auth', 'verified'])->name('start-level2');

Route::get('/level3/start-level3', function () {
    return view('level3.start-level3');
})->middleware(['auth', 'verified'])->name('start-level3');

Route::get('/level4/start-level4', function () {
    return view('level4.start-level4');
})->middleware(['auth', 'verified'])->name('start-level4');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Auth::routes([
    'verify' => true
]);

Route::get('/level1', function () {
    return view('level1.level1_obj');
})->name('level1');

Route::get('/level2', function () {
    return view('level2.level2_obj');
})->name('level2');

Route::get('/level3', function () {
    return view('level3.level3_obj');
})->name('level3');

Route::get('/level4', function () {
    return view('level4.level4_obj');
})->name('level4');


Route::get('/level3/card', function () {
    return view('level3.card');
})->middleware(['auth', 'verified'])->name('card');


Route::get('/level3/howtoplay', function () {
    return view('level3.howtoplay');
})->middleware(['auth', 'verified'])->name('howtoplay');

Route::get('/level3/quiz', function () {
    return view('level3.quiz');
})->middleware(['auth', 'verified'])->name('quiz');

Route::get('/level4/quiz/show', [MbtiQuizController::class, 'show'])->name('quiz.show');
Route::post('/level4/quiz/show', [MbtiQuizController::class, 'submit'])->name('quiz.submit');
Route::get('/level4/result', [MbtiQuizController::class, 'result'])->name('quiz.result');
Route::get('/level4/quiz/result', [App\Http\Controllers\MbtiQuizController::class, 'result'])->name('quiz.result');

Route::get('/mbti-pdf/{id}', [MBTIPDFController::class, 'generatePDF']);

Route::get('/all-mbti', [AllMbtiController::class, 'index'])->name('allMbti');

Route::get('/affect_mbti', [AffectMbtiController::class, 'index'])->middleware(['auth', 'verified'])
->name('affect_mbti');
Route::post('/update-temporary-jobs', [AffectMbtiController::class, 'updateTemporaryJobs'])->name('updateTemporaryJobs');
Route::post('/update-jobs', [AffectMbtiController::class, 'updateJobs']);
Route::post('/update-temporary-jobs', [AffectMbtiController::class, 'updateTemporaryJobs']);
Route::post('/finalize-jobs', [AffectMbtiController::class, 'finalizeJobs']);
Route::get('/check-all-users-completed', [AffectMbtiController::class, 'checkAllUsersCompleted']);

Route::get('/affichage_poste', [RecController::class, 'index'])->middleware(['auth', 'verified'])->name('affp');

Route::get('/home_mbti', [MessageController::class, 'index'])->middleware(['auth', 'verified'])->name('home_mbti');
Route::get('/messages', [MessageController::class, 'messages'])->middleware(['auth', 'verified'])->name('messages');
Route::post('/message', [MessageController::class, 'message'])->middleware(['auth', 'verified'])->name('message');

Route::get('/level1/buss_', function () {
    return view('level1.BUSINESSMODEL');
})->name('level1ns');

Route::get('/level2/submit-idea', [IdeaController::class, 'showForm'])->middleware(['auth', 'verified'])->name('submit-idea');

Route::post('/ideas', [IdeaController::class, 'store'])->middleware(['auth', 'verified'])->name('ideas.store');

Route::get('/ideas', [IdeaController::class, 'index'])->middleware(['auth', 'verified'])->name('ideas.index');

Route::post('/vote/{id}', [IdeaController::class, 'vote'])->middleware(['auth', 'verified'])->name('ideas.vote');

Route::get('/winning-idea', [IdeaController::class, 'winningIdea'])->middleware(['auth', 'verified'])->name('ideas.winning');

Route::middleware('auth')->group(function () {
    Route::get('/business-model/create', [BusinessModelController::class, 'create'])->name('business_model.create');
    Route::post('/business-model/store', [BusinessModelController::class, 'store'])->name('business_model.store');
    Route::get('/business-model/wait', [BusinessModelController::class, 'wait'])->name('business_model.wait'); // Ajouter cette ligne
    Route::get('/business-model/result', [BusinessModelController::class, 'result'])->name('business_model.result');
    Route::get('/business-model/check-completion', [BusinessModelController::class, 'checkCompletion'])->name('business_model.checkCompletion');
});

Route::get('/messages', [BusinessModelController::class, 'messages'])->middleware(['auth', 'verified'])->name('messages');
Route::post('/message', [BusinessModelController::class, 'message'])->middleware(['auth', 'verified'])->name('message');

use App\Http\Controllers\GameController;
Route::get('/level3/modellev3', function () {
    return view('level3.modellev3');
})->name('level1ns');

Route::post('/claim-idea-points', [IdeaController::class, 'claimIdeaPoints'])->middleware(['auth', 'verified'])->name('claim-idea-points');

use App\Http\Controllers\RankingController;

Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');
use App\Http\Controllers\AdminRankingController;

Route::get('/admin-ranking', [AdminRankingController::class, 'index'])->name('admin-ranking');


Route::post('/check-answers', [GameController::class, 'checkAnswers']);
require __DIR__.'/auth.php';

Route::get('/level1/FinExercice', function () {
    return view('level1.FinExercice');
})->name('FinExercice');

Route::get('/level1/StartExercice', function () {
    return view('level1.StartExercice');
})->name('StartExercice');

Route::get('/level1/ExerciceBUSINESSMODEL', function () {
    return view('level1.ExerciceBUSINESSMODEL');
})->name('ExerciceBUSINESSMODEL');


Route::get('/level1/FinLevel', function () {
    return view('level1.FinLevel');
})->name('FinLevel');



Route::post('/save-score', [ScoreController::class, 'saveScore']);

