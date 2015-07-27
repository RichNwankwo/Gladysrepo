<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(range(0,1000) as $row)
        {
            DB::table('question')->insert([
                'fact_id' => rand(1, 1000),
                'question_title' => 'Random Question String?',
                'question_type' => rand(1,5)
            ]);
        }
    }
}
