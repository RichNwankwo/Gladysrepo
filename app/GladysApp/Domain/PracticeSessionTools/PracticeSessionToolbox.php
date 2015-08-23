<?php


namespace App\GladysApp\Domain;


use App\Models\Question;
use App\Models\Fact;
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

    /**
     * @param array $tags facts tagged with these tags only
     * @return bool|mixed
     */
    public function getSessionMaterial(array $tags = [])
    {
        if($tags)
        {
            $tag_id = $tags[rand(0,count($tags)-1)];
            $fact = $this->factSelector->selectRandomTaggedFact($this->user_id,$tag_id);
        }
        else
        {
            $fact = $this->factSelector->selectRandomFact($this->user_id);
        }
        if($fact)
        {
            $fact_with_question = $this->questionSelector->getRandomQuestion($fact['id']);
            if($fact_with_question)
            {
                $fact_with_question['session_id'] = $this->session_id;
            }
            return $fact_with_question;
        }
        else
        {
            return FALSE;
        }


    }

    // TODO below functions need better error handling
    // TODO do the fact handling, then the question handling
    public function insertAnswerAsQuestion($answer , $fact_id)
    {
        Question::create([
            'fact_id' => $fact_id,
            'question_title' => $answer,
            'question_type' => 6
        ]);
    }

    public function insertAnswerAsFact($answer)
    {
        Fact::create([
            'user_id' => $this->user_id,
            'fact' => $answer
        ]);
    }

    public function insertAnswerAsFactWithQuestion($answer, $question = null)
    {
        $fact_id = Fact::create([
            'user_id' => $this->user_id,
            'fact' => $answer
        ])->id;

        if(!is_null($question))
        {
            if($question == 4)
            {
                $question_type = 8;
                $question_title = 'Have you applied this in your life? Make plans to';
            }
            elseif($question == 3)
            {
                $question_type = 7;
                $question_title = 'Can you extend on this previous thought?';
            }
            Question::create([
                'fact_id' => $fact_id,
                'question_title' => $question_title,
                'question_type' => $question_type
            ]);

        }

    }

    public function insertAnswerAsFactWithDefaultQuestions($answer)
    {
        $fact_id = Fact::create([
            'user_id' => $this->user_id,
            'fact' => $answer
        ])->id;

        $questions =  [
            ['fact_id' => $fact_id, 'question_title' => 'Can you create a test question from this fact?', 'question_type' => 1],
            ['fact_id' => $fact_id, 'question_title' => 'Write this fact in your own words', 'question_type' => 2],
            ['fact_id' => $fact_id, 'question_title' => 'Write a paragraph about the fact and its related implications','question_type' => 3],
            ['fact_id' => $fact_id, 'question_title' => 'How can you apply this to your day, or life in general?', 'question_type' => 4],
            ['fact_id' => $fact_id, 'question_title' => 'Can you find a related fact to this fact', 'question_type' => 5]
        ];
        Question::insert($questions);
    }


} 