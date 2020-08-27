<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\Answer;

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
            $count = $question->answers()->where([['question_id', $question->id],['libelle', $choice]])->count();
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
        $total = Answer::where('question_id', 1)->count();
        foreach ($questions as $question) {
            $count = 0;
            $answers = Answer::where('question_id', $question['id'])->get();
            foreach ($answers as $answer) {
                $count += $answer->libelle;
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
}
