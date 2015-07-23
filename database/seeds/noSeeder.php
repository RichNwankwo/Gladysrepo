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
        DB::table('no')->insert([

            'user_id' => rand(1,5),
            'description' => 'I said NO to this and I\'m proud',
            'added_on' => date("Y-m-d H:i:s", rand())
        ]);
    }

} 