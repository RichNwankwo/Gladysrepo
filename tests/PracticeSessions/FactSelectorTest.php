<?php

use  App\Models\Fact;
use App\Models\User;
use App\Models\Tag;
use App\Models\TaggedFact;

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
            TaggedFact::create(['fact_id' => $fact->id, 'tag_id' => $tag_id]);
        }

        $this->factSelector = new \App\GladysApp\Domain\FactSelector();
        $fact = $this->factSelector->selectRandomTaggedFact($user->id, $tag_id);
        $fact_id = $fact['id'];

        $taggedFact = TaggedFact::whereRaw("fact_id = $fact_id AND tag_id = 1")->first();

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
        $user = $this->getTestUser();
        $this->mockFacts($user, 20);
        $this->tagMockFacts($user);
        $tag_ids = [1,2,3];

        $factSelector = new \App\GladysApp\Domain\FactSelector();
        foreach($tag_ids as $tag_id)
        {
            $taggedFacts = TaggedFact::where('tag_id', '=', $tag_id)->count();
            $i = $taggedFacts;
            $fact_ids = [];
            while($i--)
            {
                $fact = $factSelector->select_unique_tagged_fact($user->id, $tag_id, $fact_ids);
                $fact_ids[] = intval($fact['id']);
            }

            $this->assertEquals($taggedFacts, count(array_unique($fact_ids)));
        }



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

    /**
     * @param $user
     */
    public function tagMockFacts($user)
    {
        // create two tags
        $tag_id = Tag::create(['tag_name' => 'Test Tag1'])->id;
        $tag_id2 = Tag::create(['tag_name' => 'Test Tag2'])->id;

        $facts = Fact::where('user_id', $user->id)->get();
        foreach ($facts as $fact)
        {
            // Basically a 50/50 coin flip whether a tag is going to get tag 1 or tag 2
            rand(0,1) ?
                \App\Models\TaggedFact::create(['fact_id' => $fact->id, 'tag_id' => $tag_id]) :
                \App\Models\TaggedFact::create(['fact_id' => $fact->id, 'tag_id' => $tag_id2])
            ;

        }
    }


} 