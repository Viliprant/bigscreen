<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [
                'libelle' => 'Votre adresse mail',
                'type' => 'B',
            ],
            [
                'libelle' => 'Votre âge',
                'type' => 'B',
            ],
            [
                'libelle' => 'Votre sexe',
                'type' => 'A',
            ],
            [
                'libelle' => 'Nombre de personne dans votre foyer (adulte & enfants)',
                'type' => 'C',
            ],
            [
                'libelle' => 'Votre profession',
                'type' => 'B',
            ],
            [
                'libelle' => 'Quel marque de casque VR utilisez vous ?',
                'type' => 'A',
            ],
            [
                'libelle' => 'Sur quel magasin d’application achetez vous des contenus VR ?',
                'type' => 'A',
            ],
            [
                'libelle' => 'Quel casque envisagez vous d’acheter dans un futur proche ?',
                'type' => 'A',
            ],
            [
                'libelle' => 'Au sein de votre foyer, combien de personne utilisent votre casque VR pour regarder Bigscreen ?',
                'type' => 'C',
            ],
            [
                'libelle' => 'Vous utilisez principalement Bigscreen pour :',
                'type' => 'A',
            ],
            [
                'libelle' => 'Combien donnez vous de point pour la qualité de l’image sur Bigscreen ?',
                'type' => 'C',
            ],
            [
                'libelle' => 'Combien donnez vous de point pour le confort d’utilisation de l’interface Bigscreen ?',
                'type' => 'C',
            ],
            [
                'libelle' => 'Combien donnez vous de point pour la connection réseau de Bigscreen ?',
                'type' => 'C',
            ],
            [
                'libelle' => 'Combien donnez vous de point pour la qualité des graphismes 3D dans Bigscreen ?',
                'type' => 'C',
            ],
            [
                'libelle' => 'Combien donnez vous de point pour la qualité audio dans Bigscreen ?',
                'type' => 'C',
            ],
            [
                'libelle' => 'Aimeriez vous avoir des notifications plus précises au cours de vos sessions Bigscreen ?',
                'type' => 'A',
            ],
            [
                'libelle' => 'Aimeriez vous pouvoir inviter un ami à rejoindre votre session via son smartphone ?',
                'type' => 'A',
            ],
            [
                'libelle' => 'Aimeriez vous pouvoir enregistrer des émissions TV pour pouvoir les regarder ultérieurement ?',
                'type' => 'C',
            ],
            [
                'libelle' => 'Aimeriez vous jouer à des jeux exclusifs sur votre Bigscreen ?',
                'type' => 'C',
            ],
            [
                'libelle' => 'Quelle nouvelle fonctionnalité de vos rêve devrait exister sur Bigscreen ?',
                'type' => 'B',
            ],
            ]);
            

    }
}
