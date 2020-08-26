<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.fr',
                'password' => Hash::make( 'admin' )
            ],
        ]);

        $this->call(QuestionSeeder::class);

        $this->call(AnswerPollSeeder::class);

    }
}
