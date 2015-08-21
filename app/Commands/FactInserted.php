<?php

namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Models\User;
use App\Models\Fact;
use App\Models\Question;

class FactInserted implements SelfHandling
{
    public  $user;
    public $fact;
    /**
     * Create a new command instance.
     *
     * @param User $user_id
     * @param Fact $fact_id
     * @return \App\Commands\FactInserted
     */

    public function __construct(User $user, Fact $fact)
    {
        $this->user = $user;
        $this->fact =  $fact;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {

        //create base question for each question
        // TODO this should actually be an event
        $fact_id = $this->fact->id;
        $questions =  [
                ['fact_id' => $fact_id, 'question_title' => 'Can you create a test question from this fact?', 'question_type' => 1],
                ['fact_id' => $fact_id, 'question_title' => 'Write this fact in your own words', 'question_type' => 2],
                ['fact_id' => $fact_id, 'question_title' => 'Write a paragraph about the fact and its related implications','question_type' => 3],
                ['fact_id' => $fact_id, 'question_title' => 'How can you apply this to your day, or life in general?', 'question_type' => 4],
                ['fact_id' => $fact_id, 'question_title' => 'Can you find a related fact to this fact', 'question_type' => 5],
                ['fact_id' => $fact_id, 'question_title' => 'Can you give an example in recent new or history related to this fact', 'question_type' => 6],
                ['fact_id' => $fact_id, 'question_title' => 'What is one key term or phrase that you can later define', 'question_type' => 7],
                ['fact_id' => $fact_id, 'question_title' => 'How can you take action on this piece of information right this moment?', 'question_type' => 8]

            ];
        Question::insert($questions);

    }
}
