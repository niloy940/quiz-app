<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//student routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/quizzes/{quiz}', [HomeController::class, 'show'])->name('student.quiz');
Route::post('/home/user/answers', [HomeController::class, 'answers'])->name('student.answers');
Route::get('/home/users/{user}/quizzes/{quiz}/results', [HomeController::class, 'result'])->name('student.result');

//admin routes
Route::middleware('can:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.home');

    Route::resource('quizzes', QuizController::class);
    
    Route::get('/quizzes/{quiz}/questions', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/quizzes/{quiz}/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
    Route::get('/quizzes/{quiz}/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::patch('/quizzes/{quiz}/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
    Route::post('/quizzes/{quiz}/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');

    Route::get('quizzes/{quiz}/questions/{question}/answers', [AnswerController::class, 'create'])->name('answers.create');
    Route::post('quizzes/{quiz}/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');
    Route::post('quizzes/{quiz}/questions/{question}/answers/{answer}', [AnswerController::class, 'destroy'])->name('answers.destroy');

    Route::get('/results/quizzes', [ResultController::class, 'index'])->name('results.index');
    Route::get('/results/quizzes/{quiz}', [ResultController::class, 'show'])->name('results.show');
});
