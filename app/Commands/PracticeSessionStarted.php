<?php

namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Models\User;
use App\Models\PracticeSession;
class PracticeSessionStarted implements SelfHandling
{
    public  $user;
    /**
     * Create a new command instance.
     *
     * @param User $user_id
     * @param Fact $fact_id
     * @return \App\Commands\FactInserted
     */

    // TODO probably going to convert this back into injected MODELS
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $practice_sessions = $this->user->practice_sessions;
        foreach($practice_sessions as $session)
        {
            if(is_null($session->completed_at))
            {
                $session->completed_at = date('Y-m-d H:i:s');
                $session->save();
            }
        }
    }
}
