<?php


namespace App\GladysApp\Domain;


interface FactSelectorInterface {

    /**
     * @param  user $id
     * @return mixed
     */
    public function selectRandomFact($user_id);

} 