<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeds the tag table
        foreach(range(1,1000) as $t)
        {
            $tag = new Tag;
            $tag->tag_name = str_shuffle('abcdefghijklmnopqrstuvwxyz');
            $tag->save();
        }
    }
}
