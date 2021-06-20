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
        $current_time = strtotime(date('Y-m-d H:i:s'));
        $start_time = strtotime($quiz->start_time);
        $end_time = strtotime($quiz->end_time);
        $time_left = ($end_time - $current_time) / 60;

        if (($current_time >= $start_time) && ($end_time > $current_time)) {
            return view('student.quizzes.show', compact('quiz', 'time_left'));
        } elseif ($current_time < $start_time) {
            session()->flash('not-started', 'Quiz is not started yet!');
            return back();
        } else {
            session()->flash('time-over', 'Time is over!');
            return back();
        }
    }

    public function answers(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $no_correct = 0;
        $no_incorrect = 0;

        if ($request->answers) {
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
        } else {
            session()->flash('select-answer', 'You must have to select answer before submit!');
            return back();
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

    public function result(User $user, Quiz $quiz)
    {
        $result = Result::where('quiz_id', $quiz->id)->where('user_id', $user->id)->first();

        return view('student.result', compact('result'));
    }
}
