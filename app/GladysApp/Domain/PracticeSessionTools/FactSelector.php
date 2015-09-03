<?php


namespace App\GladysApp\Domain;
use App\GladysApp\Transformers\FactTransformer;
use App\Models\TaggedFact;
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
        return $this->transformAndReturnFact($facts);
    }

    public function selectRandomTaggedFact($user_id, $tag_id)
    {
        $tagged_facts = TaggedFact::whereRaw("tag_id = $tag_id")->get();
        foreach($tagged_facts as $tagged_fact)
        {
            $facts[] = $tagged_fact->fact;
        }
        return $this->transformAndReturnFact($facts);
    }

    public function select_unique_fact($user_id, $excludes)
    {
        $facts = User::find($user_id)->facts()->whereNotIn('id', $excludes)->get();
        return $this->transformAndReturnFact($facts);
    }

    /**
     * @param $facts
     * @return array|bool
     */
    protected function transformAndReturnFact($facts)
    {
        if(!$facts)
        {
            return false;
        }
        $random_fact = $facts[mt_rand(0, count($facts) - 1)];
        return $this->factTransformer->transform($random_fact);
    }


}