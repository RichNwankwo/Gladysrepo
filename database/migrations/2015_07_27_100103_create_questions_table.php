<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('question', function(Blueprint $table){

            $table->increments('id')->unsigned();
            $table->integer('fact_id')->unsigned();
            $table->foreign('fact_id')->references('id')->on('fact');
            $table->string('question_title');
            $table->integer('question_type')->unsigned();
            $table->nullableTimestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('question');
    }
}
