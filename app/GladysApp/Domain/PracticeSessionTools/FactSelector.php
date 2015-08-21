<?php


namespace App\GladysApp\Domain;
use App\GladysApp\Transformers\FactTransformer;
use App\Models\User;

class FactSelector implements FactSelectorInterface{

    protected $factTransformer;

    function __construct()
    {
        $this->factTransformer = new FactTransformer();
    }

    public function selectRandomFact($user_id)
    {
        $facts = User::find($user_id)->facts;
        if(!$facts){
            return False;
        }
        $random_fact = $facts[mt_rand(0, count($facts)-1)];
        return $this->factTransformer->transform($random_fact);
    }
}