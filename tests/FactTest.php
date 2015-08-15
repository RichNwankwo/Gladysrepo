<?php


use App\Models\Fact;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

include_once('tests/resourceTester.php');

class FactTest extends resourceTester {

    protected $model = 'App\Models\Fact';


    public function setUp()
    {
        parent::setUp();
        $this->resource = $this->apiUrl.'fact';
        $this->specificResource = $this->resource.'/1';
        $transformer = new \App\GladysApp\Transformers\FactTransformer();
        $this->format =  $transformer->format;
        $this->authorization_needed = TRUE;
    }

    public function testIf_Tag_Resources_Nested_Properly()
    {
        $this->authorizeTestUser();
        //arrange
        $url = $this->resource.'/1/tag';
        $tags = [
            new App\Models\Tag(['tag_name'=>'Same Tag']),
            new App\Models\Tag(['tag_name'=>'Same Tag']),
            new App\Models\Tag(['tag_name'=>'Same Tag'])
            ];
        $this->makeRelatedModel($this->model,'tags', $tags);

        //act

        $resource = $this->getJson($url)->data;

        //assert
        $this->assertResponseOk();
        $this->assertObjectHasAttribute('tag_name', $resource[0]);

    }

    public function testIf_error_thrown_when_validation_fails()
    {
        //arrange
        $fact = ['user_id'=> 1, 'fact'=>''];
        if($this->authorization_needed === TRUE)
        {
            $this->authorizeTestUser();
        }

        //act
        $this->getJson($this->resource, "POST", $fact);


        //assert
        $this->assertResponseStatus(422);
    }

    public function testIf_error_is_thrown_if_user_not_authorized()
    {
        $fact = ['fact'=>'That maui wowie'];

        if($this->authorization_needed === TRUE)
        {
            $this->authorizeTestUser();
        }

        $resource = 'http://gladys.app/api/v1/user/26/fact/';
        $this->getJson($resource, "POST", $fact);

        $this->assertResponseStatus(403);
    }

    public function testIf_resource_is_created_successfully()
    {
        $fact = ['newFact'=>'That maui wowie'];
        if($this->authorization_needed === TRUE)
        {
            $this->authorizeTestUser();
        }
        $resource = 'http://gladys.app/api/v1/user/1/fact/';
        $this->getJson($resource, "POST", $fact);

        // assert
        $this->assertResponseStatus(201);
    }


    public function getStub()
    {
        return [
            'newFact' => $this->fake->paragraph,
            'user_id' => '1',
            'fact' => $this->fake->paragraph
        ];
    }
    
    



}
 