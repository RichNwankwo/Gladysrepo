<?php


use App\Models\No;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

include_once('tests/API/resourceTester.php');
class NoTest extends resourceTester{

    protected $model = 'App\Models\No';


    public function setUp()
    {
        parent::setUp();
        $this->resource = $this->apiUrl.'no';
        $this->specificResource = $this->resource.'/1';
        $transformer = new \App\GladysApp\Transformers\NoTransformer();
        $this->format =  $transformer->format;

    }

    public function getStub()
    {
        return [
            'user_id' => 1,
            'description' => $this->fake->sentence
        ];
    }

} 