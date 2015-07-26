<?php

namespace App\GladysApp\Transformers;
abstract class Transformer {

    /**
     * The only data that should be viewable by this resource
     * @var array
     */
    public $format;

    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);

} 