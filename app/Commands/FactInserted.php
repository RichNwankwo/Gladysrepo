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

    // TODO probably going to convert this back into injected MODELS
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
                ['fact_id' => $fact_id, 'question_title' => 'Can you create 5 questions from this fact?', 'question_type' => 1],
                ['fact_id' => $fact_id, 'question_title' => 'Write this fact in yur own words', 'question_type' => 1],
                ['fact_id' => $fact_id, 'question_title' => 'Write a paragraph about the fact and its related implications','question_type' => 1],
                ['fact_id' => $fact_id, 'question_title' => 'How can you apply this to your day, or life in general?', 'question_type' => 1],
                ['fact_id' => $fact_id, 'question_title' => 'Can you create 5 questions from this fact', 'question_type' => 1]
            ];
        Question::insert($questions);

    }
}
