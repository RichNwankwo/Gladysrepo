<?php


namespace App\GladysApp\Transformers;


class FactTransformer extends Transformer {


    public $format = ['id', 'user_id', 'fact', 'added_on'];

    public function transform($fact)
    {
        return [
            'id' => $fact['id'],
            'user_id' => $fact['user_id'],
            'fact' => $fact['fact'],
            'added_on' => $fact['created_at']
        ];
    }
}