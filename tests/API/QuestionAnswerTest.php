<?php

use App\Models\QuestionAnswer;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

include_once('tests/API/resourceTester.php');
class QuestionAnswerTest extends resourceTester {

    protected $model = 'App\Models\QuestionAnswer';


    public function setUp()
    {
        parent::setUp();
        $this->resource = $this->apiUrl.'answer';
        $this->specificResource = $this->resource.'/1';
        $transformer = new \App\GladysApp\Transformers\QuestionAnswerTransformer();
        $this->format =  $transformer->format;
        $this->authorization_needed = False;
        Artisan::call('db:seed',['--class' =>'FactSeeder']);
        Artisan::call('db:seed',['--class' =>'QuestionSeeder']);
    }

    public function getStub()
    {
        return [
            'question_id' => rand(1,10),
            'answer' => $this->fake->sentence(),
            'checked' => 1
        ];
    }


} 