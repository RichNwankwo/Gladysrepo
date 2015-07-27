<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(range(1,5) as $row)
        {
            DB::table('question_type')->insert([
               'question_type' => 'Generic Question Type'
            ]);

        }
    }
}
