<?php


namespace App\GladysApp\Transformers;


class UserTransformer extends Transformer{

    public $format = ['user_id', 'name', 'email'];
    public function transform($user)
    {
        return [
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ];
    }
}