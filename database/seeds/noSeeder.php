<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class noSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,1000) as $no)
        {
            DB::table('no')->insert([

                'user_id' => rand(1,100),
                'description' => 'I said NO to this and I\'m proud',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }

    }

} 