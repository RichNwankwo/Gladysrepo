<?php

use  App\Models\Fact;
use App\Models\User;
use App\Models\Tag;
class FactSelectorTest extends TestCase{



    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function testIf_fact_is_selected()
    {
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'testing@testing.com',
            'password' => Hash::make('testing')
        ]);

        Fact::insert([
            ['user_id'=> $user->id, 'fact'=> 'I provide that new new'],
            ['user_id'=> $user->id, 'fact'=> 'I provide that new new'],
            ['user_id'=> $user->id, 'fact'=> 'I provide that new new'],
            ['user_id'=> $user->id, 'fact'=> 'I provide that new new'],
            ['user_id'=> $user->id, 'fact'=> 'I provide that new new'],
            ['user_id'=> $user->id, 'fact'=> 'I provide that new new']
        ]);

        $this->factSelector = new \App\GladysApp\Domain\FactSelector();
        $fact = $this->factSelector->selectRandomFact($user->id);

        $this->assertArrayHasKey('user_id', $fact);

    }

    public function test_If_random_tagged_fact_is_selected()
    {
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'testing@testing.com',
            'password' => Hash::make('testing')
        ]);

        Fact::insert([
            ['user_id'=> $user->id, 'fact'=> 'I believe I can fly'],
            ['user_id'=> $user->id, 'fact'=> 'I provide that new new'],
            ['user_id'=> $user->id, 'fact'=> 'A love supreme'],
            ['user_id'=> $user->id, 'fact'=> 'Going back to honolulu'],
            ['user_id'=> $user->id, 'fact'=> 'Jesus Walks'],
            ['user_id'=> $user->id, 'fact'=> 'Ride pipe like bike like YOKOHAMA']
        ]);

        $tag_id = Tag::create(['tag_name'=> 'Test Tag'])->id;

        $facts = Fact::where('user_id', $user->id)->get();
        foreach($facts as $fact)
        {
            \App\Models\TaggedFact::create(['fact_id' => $fact->id, 'tag_id' => $tag_id]);
        }

        $this->factSelector = new \App\GladysApp\Domain\FactSelector();
        $fact = $this->factSelector->selectRandomTaggedFact($user->id, $tag_id);
        $fact_id = $fact['id'];

        $taggedFact = \App\Models\TaggedFact::whereRaw("fact_id = $fact_id AND tag_id = 1")->first();

        $this->assertEquals(1,$taggedFact->tag_id);





    }


} 