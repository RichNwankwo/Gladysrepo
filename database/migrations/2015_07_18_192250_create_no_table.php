<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the no table
        Schema::create('no', function(Blueprint $table){

            $table->increments('id');
            $table->integer('user_id');
            $table->string('description');
            $table->timestamp('added_on');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //deletes the no table

        Schema::drop('no');
    }
}
