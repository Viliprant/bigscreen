<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
            if ($question->type === 'A') {
                $JSONItem = [
                    'id' => $question->id,
                    'libelle' => $question->libelle,
                    'type' => $question->type,
                    'choices' => json_decode($question->choices),
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
        $poll = Poll::where([['url', $url], ['status', true]])->first();

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
                'email' => $poll->email,
                'answers' => $pollResponse
            ]]);
        }
    }

    public function addPoll(Request $request)
    {
        $questions = Question::all();
        $requirements = [];
        foreach ($questions as $key => $answerValue) {
            $requirements["Q".( $key + 1 )] = "required|max:255";
        }
        $requirements["email"] = "required|email";
        
        // Validation des champs
        $validator = Validator::make($request->all(), $requirements);

        $poll = Poll::where([['email', $request['email']]])->first();

        if($poll == null){
            $validator->errors()->add("email", "Email non reconnu");
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        }
        else{
            if($poll->status == true){
                $validator->errors()->add("email", "Formulaire déjà rempli");
                return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
            }
        }
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $Answers = [];
        foreach ($questions as $key => $question) {
            $newAnswer = Answer::create([
                'libelle' => $request["Q" . $question['id']],
                'question_id' => $question->id,
            ]);
            $newAnswer->save();
            array_push( $Answers, $newAnswer->id);
        }
        $poll->answers()->attach( $Answers );
        $poll->status = true;
        $poll->save();

        return view('front.pollURL', ['poll_url' => $poll->url]);
    }
}
