<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the facts table
        Schema::create('fact', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->longText('fact');
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
        // Deletes the facts table
        Schema::drop('fact');
    }
}
