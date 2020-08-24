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
        factory(App\Poll::class, 5)->create()->each(function($poll){
            $faker = \Faker\Factory::create();
            $questions = App\Question::all();

            foreach ($questions as $key => $question) {
                $answers = $question->answers;
                switch ($question->type) {
                    case 'A':
                        $indexAnswerRandom = rand(0, count($answers) - 1);
                        $poll->answers()->attach($answers[$indexAnswerRandom]->id);
                        break;
                    case 'B':
                        if($key === 0){
                            $email = $faker->unique()->safeEmail;
                            $newAnswer = App\Answer::create([
                                'libelle' => $email,
                                'question_id' => $question->id
                            ]);
                        }
                        else{
                            $randomAnswer = $faker->sentence($nbWords = 6, $variableNbWords = true);
                            $newAnswer = App\Answer::create([
                                'libelle' => $randomAnswer,
                                'question_id' => $question->id
                            ]);
                        }
                        $poll->answers()->attach($newAnswer->id);
                        break;
                    case 'C':
                        $randomNumber = rand(1, 5);
                        $newAnswer = App\Answer::create([
                            'libelle' => $randomNumber,
                            'question_id' => $question->id
                        ]);
                        $poll->answers()->attach($newAnswer->id);
                        break;
                    default:
                        break;
                }
            }
        });
        
    }
}
