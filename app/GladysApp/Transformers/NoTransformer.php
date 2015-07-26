<?php


namespace App\GladysApp\Transformers;
use App\Models\No;
use App\Models\User;


class NoTransformer extends Transformer{

    public $format = ['description', 'user'];

    public function transform($no)
    {
        return [
            'description' => $no['description'],
            'user' => User::find($no['user_id'], ['name'])
        ];
    }


}