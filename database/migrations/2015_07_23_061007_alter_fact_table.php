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
        // Adds the updated at column
        Schema::table('fact', function(Blueprint $table){
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Removes the updated at column
        Schema::table('fact', function(Blueprint $table){
           $table->dropColumn('updated_at');
        });
    }
}
