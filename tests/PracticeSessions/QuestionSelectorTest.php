<?php

use App\GladysApp\Domain\QuestionSelector;
use App\Models\Fact;
use App\Models\Question;

class QuestionSelectorTest extends TestCase {


    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    /**
     *
     */
    public function testIf_question_selected_by_fact()
    {

        //arrange
        $fact_id = Fact::create(['user_id' => 1, 'fact' => 'I hope you learn to make it on your own'])->id;

        $questions =  [
            ['fact_id' => $fact_id, 'question_title' => 'Can you create 5 questions from this fact?', 'question_type' => 1],
            ['fact_id' => $fact_id, 'question_title' => 'Write this fact in yur own words', 'question_type' => 1],
            ['fact_id' => $fact_id, 'question_title' => 'Write a paragraph about the fact and its related implications','question_type' => 1],
            ['fact_id' => $fact_id, 'question_title' => 'How can you apply this to your day, or life in general?', 'question_type' => 1],
            ['fact_id' => $fact_id, 'question_title' => 'Can you actively do or demonstrate the knowledge presented in this fact', 'question_type' => 1]
        ];
        Question::insert($questions);

        //act
        $questionRandomizer = new QuestionSelector(new \App\GladysApp\Transformers\FactTransformer, new \App\GladysApp\Transformers\QuestionTransformer);
        $fact_with_question =  $questionRandomizer->getRandomQuestion($fact_id);

        //assert
        $this->assertEquals($fact_with_question['fact_id'], $fact_id);

    }

    public function testIf_fact_and_question_returned()
    {
        //arrange
        $fact_id = Fact::create(['user_id' => 1, 'fact' => 'I hope you learn to make it on your own'])->id;

        $questions =  [
            ['fact_id' => $fact_id, 'question_title' => 'Can you create 5 questions from this fact?', 'question_type' => 1],
            ['fact_id' => $fact_id, 'question_title' => 'Write this fact in yur own words', 'question_type' => 1],
            ['fact_id' => $fact_id, 'question_title' => 'Write a paragraph about the fact and its related implications','question_type' => 1],
            ['fact_id' => $fact_id, 'question_title' => 'How can you apply this to your day, or life in general?', 'question_type' => 1],
            ['fact_id' => $fact_id, 'question_title' => 'Can you actively do or demonstrate the knowledge presented in this fact', 'question_type' => 1]
        ];
        Question::insert($questions);

        //act
        $questionRandomizer = new QuestionSelector(new \App\GladysApp\Transformers\FactTransformer, new \App\GladysApp\Transformers\QuestionTransformer);
        $fact_with_question =  $questionRandomizer->getRandomQuestion($fact_id);

        //assert
        $this->assertArrayHasKeys(['fact_id', 'user_id', 'question_title', 'question_type', 'fact'], $fact_with_question);


    }

    // TODO turn this into a helper that many different functions can extend
    public function assertObjectHasAttributes($resource, array $attributes)
    {

        foreach($attributes as $attribute)
        {
            $this->assertObjectHasAttribute($attribute, $resource);
        }
    }

    public function assertArrayHasKeys(array $keys, $resource)
    {
        foreach($keys as $key)
        {
            $this->assertArrayHasKey($key, $resource);
        }
    }


} 