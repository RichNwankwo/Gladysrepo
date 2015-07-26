<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

abstract class ApiTester extends TestCase {

    protected $fake;

    function __construct()
    {
        $this->fake = Faker::create();
    }
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function getJson($url, $method = "GET", $parameters= [])
    {
        return json_decode($this->call($method, $url, $parameters)->getContent());
    }


} 