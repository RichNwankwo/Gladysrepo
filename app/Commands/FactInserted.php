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
                ['fact_id' => $fact_id, 'question_title' => 'Can you create a question from this fact?', 'question_type' => 1],
                ['fact_id' => $fact_id, 'question_title' => 'Can you Write this idea in your own words?', 'question_type' => 2],
                ['fact_id' => $fact_id, 'question_title' => 'Can you write a paragraph about this idea and its related implications? Remember to save it!','question_type' => 3],
                ['fact_id' => $fact_id, 'question_title' => 'How can this idea be used in your life?', 'question_type' => 4],
                ['fact_id' => $fact_id, 'question_title' => 'Can you find a related idea to this fact?', 'question_type' => 5],
                ['fact_id' => $fact_id, 'question_title' => 'Can you give an example in recent new or history related to this idea?', 'question_type' => 6],
                ['fact_id' => $fact_id, 'question_title' => 'What is one key term or phrase that you can later define', 'question_type' => 7],
                ['fact_id' => $fact_id, 'question_title' => 'How can you take action on this idea right this moment?', 'question_type' => 8],
                ['fact_id' => $fact_id, 'question_title' => 'What would be the potential significance of this idea in the future', 'question_type' => 9],
                ['fact_id' => $fact_id, 'question_title' => 'What is the significance of this idea in other places of the world', 'question_type' => 10],
                ['fact_id' => $fact_id, 'question_title' => 'How would you think of this idea if you were not you? If you were a women, white, etc.', 'question_type' => 11],
                ['fact_id' => $fact_id, 'question_title' => 'Name one person you idolize. How would they interpret and use this idea', 'question_type' => 12],
                ['fact_id' => $fact_id, 'question_title' => 'What are some ideas that build up this idea ', 'question_type' => 13],
                ['fact_id' => $fact_id, 'question_title' => 'Name one field you have interest in? How would they take advantage of this idea', 'question_type' => 14],
                ['fact_id' => $fact_id, 'question_title' => 'How can you use this idea in relation tou your strengths?', 'question_type' => 15],
                ['fact_id' => $fact_id, 'question_title' => 'Can you prove this idea false?', 'question_type' => 16],
                ['fact_id' => $fact_id, 'question_title' => 'Is there an opposite to this idea?', 'question_type' => 17],
                ['fact_id' => $fact_id, 'question_title' => 'What if this idea was in a vacuum and had no constraints? What would be the effect?', 'question_type' => 19],
                ['fact_id' => $fact_id, 'question_title' => 'What would this idea be link if it exaggerated?', 'question_type' => 20],
                ['fact_id' => $fact_id, 'question_title' => 'What would this idea be like if it was minimized', 'question_type' => 21],
                ['fact_id' => $fact_id, 'question_title' => 'How can this idea relate to your goals in life', 'question_type' => 22],
                ['fact_id' => $fact_id, 'question_title' => 'Is this an idea that would be accepted or rejected by society', 'question_type' => 23],
                ['fact_id' => $fact_id, 'question_title' => 'What would be the effects if everybody accepted this idea as universal truth', 'question_type' => 24],
                ['fact_id' => $fact_id, 'question_title' => 'If you discovered this idea on your life, what would it be worth?', 'question_type' => 25],
                ['fact_id' => $fact_id, 'question_title' => 'How can this idea prepare for future?', 'question_type' => 26],
                ['fact_id' => $fact_id, 'question_title' => 'How can this idea provide a better world?', 'question_type' => 27],
                ['fact_id' => $fact_id, 'question_title' => 'How can this idea set you apart from most people', 'question_type' => 28],
                ['fact_id' => $fact_id, 'question_title' => 'How can remember this idea for future?', 'question_type' => 29],
                ['fact_id' => $fact_id, 'question_title' => 'Slowly re-read this idea', 'question_type' => 30],
                ['fact_id' => $fact_id, 'question_title' => 'Defend the merit of this idea.', 'question_type' => 31]





            ];
        Question::insert($questions);

    }
}
