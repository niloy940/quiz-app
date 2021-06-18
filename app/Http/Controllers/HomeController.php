<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $quizzes = Quiz::all();

        return view('student.home', compact('quizzes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return view('student.quizzes.show', compact('quiz'));
    }

    public function answers(Request $request)
    {
        $user = User::find(Auth::user()->id);

        foreach ($request->answers as  $answer_id) {
            $answer = Answer::where('id', $answer_id)->first();

            $question = $answer->question;

            $pivot_table =  DB::table('answer_user')->where('question_id', 1)->first();

            if ($pivot_table->question_id =! $question->id) {
                $user->answers()->attach($answer->id, ['question_id' => $question->id]);
            } else {
                return redirect(route('home'));
            }
        }


        return redirect(route('home'));
    }
}
