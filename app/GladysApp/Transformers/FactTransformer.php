<?php


namespace App\GladysApp\Transformers;


class FactTransformer extends Transformer {

    public function transform($fact)
    {
        return [
            'user_id' => $fact['user_id'],
            'fact' => $fact['fact'],
            'added_on' => $fact['created_at']
        ];
    }
}