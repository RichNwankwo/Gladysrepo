<?php


namespace App\GladysApp\Transformers;


class TagTransformer extends Transformer{

    public $format = ['id', 'tag_name'];

    public function transform($tag)
    {
        return [
            'id' => $tag['id'],
            'tag_name' => $tag['tag_name']
        ];
    }
}