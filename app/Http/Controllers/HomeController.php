<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
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
        $quizzes = Quiz::latest()->get();

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
        if (strtotime($quiz->end_time) > strtotime(date('Y-m-d H:i:s'))) {
            return view('student.quizzes.show', compact('quiz'));
        } else {
            return back();
        }
    }

    public function answers(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $no_correct = 0;
        $no_incorrect = 0;

        foreach ($request->answers as  $answer_id) {
            $answer = Answer::where('id', $answer_id)->first();

            $question = $answer->question;

            // $pivot_table =  DB::table('answer_user')->where('question_id', 1)->first();

            // if ($pivot_table->question_id =! $question->id) {
            //     $user->answers()->attach($answer->id, ['question_id' => $question->id]);
            // } else {
            //     return redirect(route('home'));
            // }

            $correct_answer = $question->answers->where('is_correct', true)->first();
            
            if ($answer->id == $correct_answer->id) {
                $no_correct++;
            }

            if ($answer->id != $correct_answer->id) {
                $no_incorrect++;
            }
        }

        $ans_id = array_values($request->answers)[0];
        $ans = Answer::where('id', $ans_id)->first();
        $quiz_id = $ans->question->quiz->id;

        if (strtotime($ans->question->quiz->end_time) < strtotime(date('Y-m-d H:i:s'))) {
            echo 'Time Up!';
            return;
        }

        Result::create([
            'quiz_id' => $quiz_id,
            'user_id' => $user->id,
            'no_correct' => $no_correct,
            'no_incorrect' => $no_incorrect,
            'score' => $no_correct
        ]);

        return redirect(route('home'));
    }
}
