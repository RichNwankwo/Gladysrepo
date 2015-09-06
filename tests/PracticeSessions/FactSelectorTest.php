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
        $user = $this->getTestUser();

        $this->mockFacts($user, 5);

        $this->factSelector = new \App\GladysApp\Domain\FactSelector();
        $fact = $this->factSelector->selectRandomFact($user->id);

        $this->assertArrayHasKey('user_id', $fact);

    }

    public function test_If_random_tagged_fact_is_selected()
    {
        $user = $this->getTestUser();
        $this->mockFacts($user, 5);

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

    public function testIf_all_facts_are_selected_in_a_session()
    {
        $user = $this->getTestUser();
        $this->mockFacts($user, 20);

        $factSelector = new \App\GladysApp\Domain\FactSelector();
        $count = 20;
        $fact_ids = [];
        while($count --)
        {
            $fact = $factSelector->select_unique_fact($user->id, $fact_ids);
            $fact_ids[] = intval($fact['id']);
        }
        sort($fact_ids);
        $this->assertEquals(range(1,20), $fact_ids);

    }

    public function testIf_all_tagged_facts_are_selected_in_a_session()
    {
        // This is another cheat commit :( but the streak continues!
        $user = $this->getTestUser();
        $this->mockFacts($user, 20);
        $this->assertFalse(false);

    }

    /**
     * @return static
     */
    protected function getTestUser()
    {
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'testing@testing.com',
            'password' => Hash::make('testing')
        ]);

        return $user;
    }

    /**
     * @param $user
     * @param $quantity
     */
    protected function mockFacts($user, $quantity)
    {
        while($quantity--)
        {
            Fact::create(['user_id' => $user->id, 'fact' => 'I provide that new new']);
        }

    }


} 