<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerPollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_poll', function (Blueprint $table) {
            // Foreign Key
            $table->foreignId('poll_id')
            ->nullable()
            ->constrained()
            ->onDelete('SET NULL');

            $table->foreignId('answer_id')
            ->nullable()
            ->constrained()
            ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_poll');
    }
}
