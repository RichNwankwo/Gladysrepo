<?php


namespace App\GladysApp\Domain;
use App\GladysApp\Transformers\FactTransformer;
use App\Models\User;

class FactSelector implements FactSelectorInterface{

    protected $factTransformer;

    function __construct( FactTransformer $factTransformer)
    {
        $this->factTransformer = $factTransformer;
    }

    // TODO crn Put in find or fails incase we get a fact that has no questions
    public function selectRandomFact($user_id)
    {
        $facts = User::find($user_id)->facts;
        $random_fact = $facts[mt_rand(0, count($facts)-1)];
        return $this->factTransformer->transform($random_fact);
    }
}