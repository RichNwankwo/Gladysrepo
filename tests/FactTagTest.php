<?php

include_once('tests/ApiTester.php');
class FactTagTest extends ApiTester{


    public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed',['--class' =>'FactSeeder']);
    }

    public function testIfFactIsProperlyTagged()
    {

        //arrange
        $url = 'api/v1/fact/1/tag';
        $url = 'api/v1/fact/1/tag';
        $tag = ['tag_name' => "This is a test tag"];
        $this->authorizeTestUser();


        //act
        $this->getJson($url, "POST", $tag);
//        $response2 = $this->getJson($url,"POST", $tag)->data;


        //assert
        $this->assertResponseStatus(201);

        $this->getJson($url, "POST", $tag);
        $this->assertResponseStatus(201);

    }


    public function getStub()
    {
        return [
            'fact_id' => $this->fake->paragraph,
            'tag_id' => $this->fake->numberBetween(1,10),
        ];
    }
} 