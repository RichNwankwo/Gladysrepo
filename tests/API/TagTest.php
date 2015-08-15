<?php

use App\Models\Tag;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

include_once('tests/API/resourceTester.php');
class TagTest extends resourceTester{

    protected $model = 'App\Models\Tag';

    public function setUp()
    {
        parent::setUp();
        $this->resource = $this->apiUrl.'tag';
        $this->specificResource = $this->resource.'/1';
        $transformer = new \App\GladysApp\Transformers\TagTransformer();
        $this->format =  $transformer->format;
    }

    public function getStub()
    {
        return [
            'tag_name' => $this->fake->word
        ];
    }

} 