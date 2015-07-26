<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the pivot table for tags and facts
        Schema::create('facts_tags', function(Blueprint $table){
            
            $table->increments('id')->unsigned();
            $table->integer('fact_id')->unsigned();
            $table->foreign('fact_id')->references('id')->on('fact');
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tag');
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
        // Drops the pivot table for tags and facts
        Schema::drop('facts_tags');
    }
}
