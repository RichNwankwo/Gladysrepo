<?php


use App\Models\Fact;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

include_once('tests/resourceTester.php');

class FactTest extends resourceTester {

    /**
     * The path to the model resource represents
     * @var string
     */
    protected $model = 'App\Models\Fact';

    /**
     * path to uri resource segment
     * @var string
     */

    /**
     * api url
     * @var string
     */



    public function setUp()
    {
        parent::setUp();
        $this->resource = $this->apiUrl.'fact';
        $this->specificResource = $this->resource.'/1';
        $transformer = new \App\GladysApp\Transformers\FactTransformer();
        $this->format =  $transformer->format;
    }


    public function getStub()
    {
        return [
            'user_id' => $this->fake->numberBetween(1,10),
            'fact' => $this->fake->paragraph
        ];
    }



}
 