<?php

use App\Models\Question;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

include_once('tests/API/resourceTester.php');
class QuestionTest extends resourceTester {

    protected $model = 'App\Models\Question';


    public function setUp()
    {
        parent::setUp();
        $this->resource = $this->apiUrl.'question';
        $this->specificResource = $this->resource.'/1';
        $transformer = new \App\GladysApp\Transformers\QuestionTransformer();
        $this->format =  $transformer->format;
        $this->authorization_needed = False;
        Artisan::call('db:seed',['--class' =>'FactSeeder']);
    }

    public function getStub()
    {
        return [
            'fact_id' => rand(1,10),
            'question_title' => $this->fake->sentence(),
            'question_type' => 1
        ];
    }

} 