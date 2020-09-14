<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\Answer;
use App\Poll;

class AdminController extends Controller
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
        $graphData = [];

        array_push($graphData, $this->getStatFromIdQuestionForPieChart(5));
        array_push($graphData, $this->getStatFromIdQuestionForPieChart(6));
        array_push($graphData, $this->getStatFromIdQuestionForPieChart(9));
        array_push($graphData, $this->getStatFromIdQuestionForRadarChart(
        [
            [
                'id' => 10,
                'libelle' => "Qualité de l'image",
            ],
            [
                'id' => 11,
                'libelle' => "Confort d'utilisation",
            ],
            [
                'id' => 12,
                'libelle' => "Connection réseau",
            ],
            [
                'id' => 13,
                'libelle' => "Qualité des graphisme",
            ],
            [
                'id' => 14,
                'libelle' => "Qualité audio",
            ],
        ], "Qualité"));

        return view('admin.home', ['graphData' => $graphData]);
    }

    private function getStatFromIdQuestionForPieChart($id){
        $question = Question::with("answers")->where('id', $id)->first();
        $stats = [];
        foreach (json_decode($question->choices) as $choice) {
            $count = $question->answers()->where('libelle', $choice)->count();
            $statChoice = [
                'libelle' => $choice,
                'count' => $count,
            ];
            array_push($stats, $statChoice);
        }

        return [
            'stats' => $stats,
            'libelle' => $question->libelle,
            'type' => 'pie'
        ];
    }
    private function getStatFromIdQuestionForRadarChart(array $questions, string $libelle){
        $stats = [];
        $total = Poll::where('status', true)->count(); // Total de formulaires remplis
        foreach ($questions as $question) {
            $count = 0;
            $answers = Answer::where('question_id', $question['id'])->get();
            foreach ($answers as $answer) {
                $count += $answer->libelle; // On additionne les points de tous les formulaires pour chaque question
            }
            $count = round( ($count / count($answers) ), 2 ); // MOYENNE
            $result = [
                'libelle' => $question['libelle'],
                'count' => $count,
            ];
            array_push($stats, $result);
        }
        return [
            'stats' => $stats,
            'libelle' => $libelle,
            'label' => "Moyenne sur $total personnes",
            'type' => 'radar'
        ];
    }

    public function getQuestions(){
        $questions = Question::get();
        $questionsData = [];
        array_push($questionsData, [
            'libelle' => 'Votre adresse mail',
            'type' => 'B',
            'nth' => 1,
        ]);
        foreach ($questions as $question) {
            array_push($questionsData, [
                'libelle' => $question->libelle,
                'type' => $question->type,
                'nth' => ($question->id + 1),
            ]);
        }
        return view('admin.questions', ['questions' => $questionsData]);
    }

    public function getAnswers(){
        $pollsData = [];
        $polls = Poll::with('answers')->where('status', true)->get();
        foreach ($polls as $poll) {
            $pollData = [];
            array_push($pollData, [
                'question' => 'Votre adresse mail',
                'libelle' => $poll->email,
                'nth' => 1,
            ]);
            foreach ($poll->answers()->with('question')->get() as $answer) {
                array_push($pollData, [
                    'question' => $answer->question->libelle,
                    'libelle' => $answer->libelle,
                    'nth' => ($answer->question->id) + 1,
                ]);
            }
            array_push($pollsData, ['answers' => $pollData]);
        }

        return view('admin.answers', ['pollsData' => $pollsData]);
    }
}
