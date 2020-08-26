<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Question;
use App\Poll;
use App\Answer;

class FrontController extends Controller
{
    public function index()
    {
        $questions = Question::with('answers')->get();
        $questionsResponse = [];
        foreach ($questions as $question) {
            $answers = [];
            if ($question->type === 'A') {
                foreach ($question->answers as $answer) {
                    array_push($answers, [
                        'id' => $answer->id,
                        'libelle' => $answer->libelle,
                    ]);
                }
                $JSONItem = [
                    'id' => $question->id,
                    'libelle' => $question->libelle,
                    'type' => $question->type,
                    'answers' => $answers,
                ];
            } else {
                $JSONItem = [
                    'id' => $question->id,
                    'libelle' => $question->libelle,
                    'type' => $question->type,
                ];
            }
            array_push($questionsResponse, $JSONItem);
        }

        return view('front.pollForm', ['questions' => $questionsResponse]);
    }

    public function getPoll(String $url)
    {
        $poll = Poll::where('url', $url)->first();

        if ($poll == null) {
            abort(404);
        } else {
            $pollResponse = [];
            $answers = $poll->answers()->with('question')->orderBy('question_id')->get();
            foreach ($answers as $answer) {
                $answers = [
                    'libelle' => $answer->libelle,
                    'question' => [
                        'libelle' => $answer->question->libelle,
                    ]
                ];
                array_push($pollResponse,$answers);
            }
            return view('front.pollResult', ['poll' => [
                'created_at' => $poll->created_at,
                'answers' => $pollResponse
                ]]);
        }
    }

    public function addPoll(Request $request){

        $requirements = [];
        foreach ($request->all() as $key => $answerValue) {
            if($key !== '_token'){
                if($key === "Q1"){
                    $requirements["$key"] = 'required|email';
                }
                else{
                    $requirements["$key"] = 'required';
                }
            }          
        }

        // Validation des champs
        $validator = Validator::make($request->all(), $requirements);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
            $alreadyUsed = Answer::where([['question_id', 1], ['libelle', $request['Q1']]])->first();

            if($alreadyUsed != null){
                $validator->errors()->add("Q1", "Email déjà utilisé");
                return redirect()
                                ->back()
                                ->withErrors($validator)
                                ->withInput();
            }
        }

        // Create Poll
        $poll = Poll::create([
            'url' => Str::random(40),
        ]);
        $poll->save();

        $idsAnswerA = [];
        $Answers = [];
        foreach (Question::all() as $key => $question) {
            if($question['type'] === 'A'){
                array_push( $idsAnswerA, $request["A" . $question['id']]);
            }
            else{
                $newAnswer = Answer::create([
                    'libelle' => $request["Q" . $question['id']],
                    'question_id' => $question->id,
                ]);
                $newAnswer->save();
                array_push( $Answers, $newAnswer->id);
            }
        }
        $poll->answers()->attach( array_merge($idsAnswerA,$Answers));

        return view('front.pollURL', ['poll_url' => $poll->url]);
    }
}
