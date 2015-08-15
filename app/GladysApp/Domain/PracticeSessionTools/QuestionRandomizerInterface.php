<?php

namespace App\GladysApp\Domain;
interface QuestionRandomizerInterface {

    /**
     * @param $fact Fact that we need a random question for
     * @return mixed
     */
    public function getRandomQuestion($fact_id);

} 