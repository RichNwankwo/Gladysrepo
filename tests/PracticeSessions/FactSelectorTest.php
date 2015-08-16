<?php

use  App\Models\Fact;
use App\Models\User;
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

        $this->factSelector = new \App\GladysApp\Domain\FactSelector(new \App\GladysApp\Transformers\FactTransformer);
        $fact = $this->factSelector->selectRandomFact($user->id);

        $this->assertArrayHasKey('user_id', $fact);

    }


} 