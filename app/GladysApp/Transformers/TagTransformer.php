<?php


namespace App\GladysApp\Transformers;


class TagTransformer extends Transformer{

    public $format = ['tag_name'];

    public function transform($tag)
    {
        return [
            'tag_name' => $tag['tag_name']
        ];
    }
}