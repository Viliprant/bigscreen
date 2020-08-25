<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Question;
use App\Poll;

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
        for ($i=0; $i < 20; $i++) { 
            if($i === 0){
                $requirements["Q$i"] = 'required|email';
            }
            else{
                $requirements["Q$i"] = 'required';
            }
        }

        // Validation des champs
        $validator = Validator::make($request->all(), $requirements);
        $validator->errors()->add("Q0", "Email déjà utilisé");
        return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
         
        return response()->json([
            'request' => $request->all(),
            'requirements' => $requirements,
            'validator->fails' => $validator->fails(),
        ]);
    }
}
