<?php


namespace App\GladysApp\Transformers;


class TagTransformer extends Transformer{

    public function transform($tag)
    {
        return [
            'tag_id' =>  $tag['id'],
            'tag_name' => $tag['tag_name']
        ];
    }
}