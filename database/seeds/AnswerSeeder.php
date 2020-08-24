<?php

use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            [
                'libelle' => 'Homme',
                 'question_id' => 3,
            ],
            [
                'libelle' => 'Femme',
                 'question_id' => 3,
            ],
            [
                'libelle' => 'Préfère de pas répondre',
                 'question_id' => 3,
            ],
            [
                'libelle' => 'Occulus Rift/s',
                 'question_id' => 6,
            ],
            [
                'libelle' => 'HTC Vive',
                 'question_id' => 6,
            ],
            [
                'libelle' => 'Windows Mixed Reality',
                 'question_id' => 6,
            ],
            [
                'libelle' => 'PSVR',
                 'question_id' => 6,
            ],
            [
                'libelle' => 'SteamVR',
                 'question_id' => 7,
            ],
            [
                'libelle' => 'Occulus store',
                 'question_id' => 7,
            ],
            [
                'libelle' => 'Viveport',
                 'question_id' => 7,
            ],
            [
                'libelle' => 'Playstation VR',
                 'question_id' => 7,
            ],
            [
                'libelle' => 'Google Play',
                 'question_id' => 7,
            ],
            [
                'libelle' => 'Windows store',
                 'question_id' => 7,
            ],
            [
                'libelle' => 'Occulus Quest',
                 'question_id' => 8,
            ],
            [
                'libelle' => 'Occulus Go',
                 'question_id' => 8,
            ],
            [
                'libelle' => 'HTC Vive Pro',
                 'question_id' => 8,
            ],
            [
                'libelle' => 'Autre',
                 'question_id' => 8,
            ],
            [
                'libelle' => 'Aucun',
                 'question_id' => 10,
            ],
            [
                'libelle' => 'regarder des émissions TV en direct',
                 'question_id' => 8,
            ],
            [
                'libelle' => 'regarder des films',
                 'question_id' => 10,
            ],
            [
                'libelle' => 'jouer en solo',
                 'question_id' => 10,
            ],
            [
                'libelle' => 'jouer en team',
                 'question_id' => 10,
            ],
            [
                'libelle' => 'Oui',
                 'question_id' => 16,
            ],
            [
                'libelle' => 'Non',
                 'question_id' => 16,
            ],
            [
                'libelle' => 'Oui',
                 'question_id' => 17,
            ],
            [
                'libelle' => 'Non',
                 'question_id' => 17,
            ],
            
        ]);
    }
}
