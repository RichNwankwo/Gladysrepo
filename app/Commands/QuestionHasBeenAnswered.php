<?php

namespace App\Commands;

use App\Commands\Command;
use App\Models\QuestionAnswer;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Models\User;
use App\Models\PracticeSession;
use App\GladysApp\Domain\PracticeSessionToolbox;
class QuestionHasBeenAnswered implements SelfHandling
{
    protected  $questionAnswer;

    /**
     * Create a new command instance.
     *
     * @param QuestionAnswer $questionAnswer
     * @param $user_id
     * @param $session_id
     * @return \App\Commands\QuestionHasBeenAnswered
     */

    public function __construct(QuestionAnswer $questionAnswer, $user_id, $session_id)
    {
        $this->questionAnswer = $questionAnswer;

        $this->PracticeSessionToolbox = new PracticeSessionToolbox($user_id, $session_id);
    }

    /**
     * Execute the command.
     *
     * @return void
     */

    // TODO Needs to be cleaned up and handled better?
    // TODO handle... what if we get a blank answer?
    public function handle()
    {
        $question = $this->questionAnswer->question;

        $answer = $this->questionAnswer->answer;
        $question_type = $question->question_type;
        $fact_id = $question->fact_id;
        switch($question_type)
        {
            CASE  1:
                // Put the answer as a question for the fact
//                dd("dis 1");
                $this->PracticeSessionToolbox->insertAnswerAsQuestion($answer, $fact_id);
                break;
            CASE  2:
                // Put the answer as a fact for the user
//                dd("dis 2");
                $this->PracticeSessionToolbox->insertAnswerAsFactWithDefaultQuestions($answer);
                break;
            CASE  3:
                // Put the answer as a fact for the user
                // With the ? Can you extend on this previous thought?
//                dd("dis 3");
                $this->PracticeSessionToolbox->insertAnswerAsFactWithQuestion($answer, 3);
                break;
            CASE  4:
                // Put this as a fact with the
                //? "Have you applied this in your life? Make plans to"
//                dd("dis 4");
                $this->PracticeSessionToolbox->insertAnswerAsFactWithQuestion($answer, 4);
                break;
            CASE  5:
                // Put this as a fact
                // With the typical questions
//                dd("dis 5");
                $this->PracticeSessionToolbox->insertAnswerAsFactWithDefaultQuestions($answer);
                break;
            default:
                "";
        }
    }
}
