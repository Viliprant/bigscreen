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
        $questions = Question::get();
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
            foreach ($poll->answers as $answer) {
                $answers = [
                    'libelle' => $answer->libelle,
                    'question' => [
                        'libelle' => $answer->question->libelle,
                    ]
                ];
                array_push($pollResponse,$answers);
            }
            return view('front.pollResult', ['poll' => [
                'created_at' => $answer->created_at,
                'answers' => $pollResponse
                ]]);
        }
    }

    public function addPoll(Request $request){

        $requirements = [];
        foreach ($request->all() as $key => $answerValue) {
            if($key !== '_token'){
                if($key === "Q0"){
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
            $alreadyUsed = Answer::where([['question_id', 1], ['libelle', $request['Q0']]])->first();

            if($alreadyUsed != null){
                $validator->errors()->add("Q0", "Email déjà utilisé");
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

        $arraytest = [];
        foreach ($request->all() as $key => $answerValue) {
            if($key !== '_token'){
                if($key[0] == 'A'){
                    $idAnswer = $answerValue;
                    $poll->answers()->attach($idAnswer);
                }
                else{
                    $newAnswer = Answer::create([
                        'libelle' => $answerValue,
                    ]);
                    $newAnswer->question()->associate(intval(substr( $key, 1 )) + 1 );
                    $newAnswer->save();
                    $poll->answers()->attach($newAnswer->id);
                }
            }
        }
         
        return response()->json([
            'poll_url' => $poll->url,
        ]);
    }
}
