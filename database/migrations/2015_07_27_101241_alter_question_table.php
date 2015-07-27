<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('question', function(Blueprint $table){

            $table->foreign('fact_id')->references('id')->on('fact');
            $table->foreign('question_type')->references('id')->on('question_type');

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
        Schema::table('question', function(Blueprint $table){

            $table->dropForeign('fact_id');
            $table->dropForeign('question_type');

        });
    }
}
