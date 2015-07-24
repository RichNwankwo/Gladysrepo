<?php

use Illuminate\Database\Seeder;


class FactTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeds the fact - tag pivot table
        foreach(range(1,100) as $key => $row)
        {
            DB::table('facts_tags')->insert([
                'fact_id' => rand(1,1000),
                'tag_id' => rand(1,1000),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
