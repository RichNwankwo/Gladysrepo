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

    /**
     * @param string $url path to resource
     * @param string $method HTTP method verb
     * @param array $parameters parameters to be passed with request
     * @return mixed
     */
    public function getJson($url, $method = "GET", $parameters = [])
    {
        return json_decode($this->call($method, $url, $parameters)->getContent());
    }

    protected function authorizeTestUser()
    {

        $user = new App\Models\User([
            'name' => 'Test User',
            'email' => 'testing@testing.com',
            'password' => Hash::make('testing')
        ]);
        $this->be($user);
    }


} 