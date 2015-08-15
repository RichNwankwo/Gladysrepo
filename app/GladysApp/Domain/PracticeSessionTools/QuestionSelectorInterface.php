<?php

namespace App\GladysApp\Domain;
interface QuestionSelectorInterface {

    /**
     * @param $fact Fact that we need a random question for
     * @return mixed
     */
    public function getRandomQuestion($fact_id);

} 