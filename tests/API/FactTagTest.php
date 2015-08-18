<?php

include_once('tests/helpers/ApiTester.php');
use App\Models\Fact;
class FactTagTest extends ApiTester {


    public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed',['--class' =>'FactSeeder']);
    }

    public function testIfFactIsProperlyTagged()
    {
        //arrange

        $fact_id = Fact::create(['user_id'=> 1, 'fact'=> 'If I give you the funk, you gon take it?'])->id;

        $url = "api/v1/user/1/fact/$fact_id/tag";
        $tag = ['tag_name' => "This is a test tag"];
        $this->authorizeTestUser();


        //act
        $this->getJson($url, "POST", $tag);
//        $response2 = $this->getJson($url,"POST", $tag)->data;


        //assert
        $this->assertResponseStatus(201);

    }

    public function testIf_user_not_authorized_throw_error()
    {
        //arrange
        // User is trying to edit a resource he doesn't posses
        $this->authorizeTestUser(); // user_id = 1
        $fact_id = Fact::create(['user_id'=> 10, 'fact'=> 'If I give you the funk, you gon take it?'])->id;
        $url = "api/v1/user/10/fact/$fact_id/tag";
        $tag = ['tag_name' => "This is a test tag"];

        // act
        $this->getJson($url, "POST", $tag);


        //assert
        $this->assertResponseStatus('403');
    }

    public function testIf_user_edits_unauthorized_resource_throw_error()
    {
        //arrange
        // User is trying to edit a resource he doesn't posses
        $this->authorizeTestUser(); // user_id = 1
        $fact_id = Fact::create(['user_id'=> 10, 'fact'=> 'If I give you the funk, you gon take it?'])->id;
        $url = "api/v1/user/1/fact/$fact_id/tag";
        $tag = ['tag_name' => "This is a test tag"];

        // act
       $this->getJson($url, "POST", $tag);



        //assert
        $this->assertResponseStatus('403');

    }


    public function getStub()
    {
        return [
            'fact_id' => $this->fake->paragraph,
            'tag_id' => $this->fake->numberBetween(1,10),
        ];
    }
} 