<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder{


    public function run()
    {
        foreach(range(1,100) as $user)
        {
            DB::table('users')->insert([

                'name' => str_random(10),
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('secret')
            ]);
        }
    }

} 