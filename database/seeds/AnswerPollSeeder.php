<?php

use Illuminate\Database\Seeder;

class AnswerPollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Poll::class, 5)->create(); // création sans réponses
        factory(App\Poll::class, 15)->create()->each(function($poll){
            $faker = \Faker\Factory::create();
            $questions = App\Question::all();

            foreach ($questions as $key => $question) {
                switch ($question->type) {
                    case 'A':
                        $choices = json_decode($question->choices);
                        $libelle = $choices[rand(0, count($choices) - 1)];
                        $newAnswer = App\Answer::create([
                            'libelle' => $libelle,
                            'question_id' => $question->id,
                            'poll_id' => $poll->id,
                        ]);
                        break;
                    case 'B':
                        $randomAnswer = $faker->sentence($nbWords = 6, $variableNbWords = true);
                        $newAnswer = App\Answer::create([
                            'libelle' => $randomAnswer,
                            'question_id' => $question->id,
                            'poll_id' => $poll->id,
                        ]);
                        break;
                    case 'C':
                        $randomNumber = rand(1, 5);
                        $newAnswer = App\Answer::create([
                            'libelle' => $randomNumber,
                            'question_id' => $question->id,
                            'poll_id' => $poll->id,
                        ]);
                        break;
                    default:
                        break;
                }
                $newAnswer->save();
            }

            // On valide le poll
            $poll->status = true;
            $poll->save();
        });
        
    }
}
