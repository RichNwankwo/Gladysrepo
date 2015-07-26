<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


include_once('tests/ApiTester.php');
class resourceTester extends ApiTester{

    use Factory;

    protected $apiUrl = 'api/v1/';
    protected $resource;
    protected $specificResource;
    protected $model;
    protected $format = null;

    public function testIf_it_returns_all_resources()
    {
        // arrange
        $this->times(5)->make($this->model);

        // act
        $this->getJson($this->resource)->data;

        // assert
        $this->assertResponseOk();
    }

    public function testIf_it_returns_specific_resource()
    {
        $this->make($this->model);
        $this->getJson($this->specificResource);
        $this->assertResponseOk();
    }

    public function testIf_data_is_transformed()
    {
        if( ! is_null($this->format))
        {
            // arrange
            $this->make($this->model);

            //act
            $resource = $this->getJson($this->specificResource)->data;

            // assert
            $this->assertObjectHasAttributes($resource, $this->format);
        }

    }


    public function testIf_collection_is_transformed()
    {
        if( ! is_null($this->format))
        {
            // arrange
            $this->times(10)->make($this->model);

            //act
            $resource = $this->getJson($this->resource)->data;

            //assert
            $this->assertObjectHasAttributes($resource[0], $this->format);
            $this->assertObjectHasAttributes($resource[1], $this->format);
            $this->assertObjectHasAttributes($resource[2], $this->format);

        }
    }

    public function testIf_resource_is_created_successfully()
    {
        //arrange
        $mock_model = $this->getStub();
        $model_class = $this->model;

        //act
        $this->getJson($this->resource,"POST", $mock_model);

        //assert
        $this->assertResponseOk();
        $inserted_model  = $model_class::find(DB::getPdo()->lastInsertId());
        $this->assertModelMatchesStub($mock_model, $inserted_model);

    }


    public function assertObjectHasAttributes($resource, array $attributes)
    {
        foreach($attributes as $attribute)
        {
            $this->assertObjectHasAttribute($attribute, $resource);
        }
    }

    /**
     * Tests if model a stub and model match data
     * @param $mock_model
     * @param $model
     */
    public function assertModelMatchesStub($mock_model, $model)
    {
        foreach($model as $field => $value) {
            $this->assertEquals($value, $model->$field);
        }
    }


}