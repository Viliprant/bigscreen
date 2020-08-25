<?php

namespace App\Http\Controllers;

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

        // return view('front.index', ['response' => 'test']);
        return response()->json([
            'questions' => $questionsResponse
        ]);
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
                    'id' => $answer->id,
                    'libelle' => $answer->libelle,
                    'question' => [
                        'id' => $answer->question_id,
                        'libelle' => $answer->question->libelle,
                    ]
                ];
                array_push($pollResponse, $answers);
            }
            return response()->json([
                'poll' => $pollResponse,
            ]);
        }
    }
}
