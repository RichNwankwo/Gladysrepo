<?php

include_once('tests/helpers/resourceTester.php');

class PracticeSessionTest extends ApiTester{

//    public function testIfNewSessionIsStarted()
//    {
//        //arrange
//        // When I start a new session based on my current facts
//        $this->authorizeTestUser();
//        $session = $this->getStub();
//
//
//
//        // act
//        // I should get the starting question based on my facts
//        $sessionData = $this->getJson('api/v1/practice_session', "POST", $session)->data();
//
//        //assert
//        // And my session should start in the database
//        $this->assertResponseStatus(201);
////        $this->assertEquals($session['started_at'], $sessionData['started_at']);
//    }

//    public function testIfPracticeQuestionIsGiven()
//    {
//        $this->authorizeTestUser();
//        $session = $this->getStub();
//
//        $sessionData = $this->getJson('api/v1/practice_session', "POST", $session)->data();
//
//        if($this->assertResponseStatus(201))
//        {
//
//        }
//    }

    public function testIfAnswerIsPosted()
    {
        //arrange
        // When I post an answer
        // I should have it saved in the DB

    }

    public function getStub()
    {
        return [
            'user_id' => 1,
            'started_at' => date("Y-m-d H:i:s"),
            'completed_at' => NULL
        ];
    }



} 