<?php

namespace App\GladysApp\Domain;

use App\Models\Fact;
use App\Models\Question;
use App\GladysApp\Transformers\FactTransformer;
use App\GladysApp\Transformers\QuestionTransformer;


/**
 * Class QuestionSelector
 * Gets Questions for session
 */
class QuestionSelector implements QuestionSelectorInterface {

    protected $sessionQuestionTransformer;
    protected $questionTransformer;
    protected $factTransformer;

    /**
     * @param FactTransformer $factTransformer
     * @param QuestionTransformer $questionTransformer
     */
    function __construct(FactTransformer $factTransformer, QuestionTransformer $questionTransformer)
    {
        $this->factTransformer = $factTransformer;
        $this->questionTransformer = $questionTransformer;
    }


    /**
     * @param $fact_id  Fact that we need a random question for
     * @return mixed
     */
    // TODO crn Put in find or fails incase we get a fact that has no questions
    public function getRandomQuestion($fact_id)
    {

        $fact = Fact::find($fact_id);
        $questions = $fact->questions;
        // Gets a random question from 0 to max number of questions available
        $random_question = $questions[mt_rand(0,count($questions)-1)];
        $fact_with_question = $this->returnFactWithQuestion($fact, $random_question);
        return $fact_with_question;
    }

    /**
     * @param $fact
     * @param $random_question
     * @return array
     */
    protected function returnFactWithQuestion($fact, $random_question)
    {
        $fact_with_question = array_merge($this->factTransformer->transform($fact), $this->questionTransformer->transform($random_question));
        return $fact_with_question;
    }


} 