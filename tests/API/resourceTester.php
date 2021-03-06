<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;



include_once('tests/helpers/ApiTester.php');
class resourceTester extends ApiTester{

    use Factory;

    /**
     * @var string
     */
    protected $apiUrl = 'api/v1/';
    /**
     * @var resource URL
     */
    protected $resource;
    /**
     * @var URL to specific resource
     */
    protected $specificResource;
    /**
     * @var Model used in resource
     */
    protected $model;
    /**
     * @var Format data is transformed to
     */
    protected $format = null;

    /**
     * @var bool Is auth needed to access data
     */
    protected $authorization_needed = TRUE;

    public function testIf_it_returns_all_resources()
    {
        $this->authorizeTestUser();
        // arrange
        $this->times(5)->make($this->model);

        // act
        $this->getJson($this->resource)->data;

        // assert
        $this->assertResponseOk();
    }

    public function testIf_it_returns_specific_resource()
    {
        $this->authorizeTestUser();
        $this->make($this->model);
        $this->getJson($this->specificResource);
        $this->assertResponseOk();
    }

    public function testIf_data_is_transformed()
    {
        $this->authorizeTestUser();
        if( ! is_null($this->format))
        {
            // arrange
            $this->make($this->model);

            //act
            $resource = $this->getJson($this->specificResource)->data;

            // assert
            $this->assertObjectHasAttributes($resource[0], $this->format);
        }

    }


    public function testIf_collection_is_transformed()
    {
        $this->authorizeTestUser();
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
        $this->authorizeTestUser();

        //act
        $this->getJson($this->resource,"POST", $mock_model);

        //assert
        $this->assertResponseStatus('201');
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

    /**
     * @return array
     */



}