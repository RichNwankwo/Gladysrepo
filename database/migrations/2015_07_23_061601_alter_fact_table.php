<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Changes the added on to created at
        Schema::table('fact', function(Blueprint $table){

            $table->renameColumn('added_on', 'created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Changes the created_at  to added_on
        Schema::table('fact', function(Blueprint $table){
            $table->renameColumn('created_at','added_on');
        });
    }
}
