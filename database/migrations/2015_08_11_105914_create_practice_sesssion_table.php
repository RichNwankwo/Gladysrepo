<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracticeSesssionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('practice_session', function(Blueprint $table){

            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();


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
        Schema::drop('practice_session');
    }
}
