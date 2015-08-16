<?php


namespace App\GladysApp\Domain;


class PracticeSessionToolbox {

    protected $factSelector;
    protected $questionSelector;
    protected $user_id;

    function __construct($user_id, $session_id)
    {
        $this->user_id = $user_id;
        $this->session_id = $session_id;
        $this->questionSelector = new QuestionSelector();
        $this->factSelector = new FactSelector();
    }

    public function getSessionMaterial()
    {
        $fact = $this->factSelector->selectRandomFact($this->user_id);
        $fact_with_question = $this->questionSelector->getRandomQuestion($fact['id']);
        $fact_with_question['session_id'] = $this->session_id;
        return $fact_with_question;
    }


} 