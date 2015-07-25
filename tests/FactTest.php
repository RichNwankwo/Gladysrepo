<?php


use App\Models\Fact;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

include_once('tests/ApiTester.php');

class FactTest extends ApiTester {
    use Factory;

    public function testIf_it_returns_facts()
    {
        // arrange
        $this->times(5)->make('App\Models\Fact');

        // act
        $this->getJson('api/v1/fact');

        // assert
        $this->assertResponseOk();
    }

    public function getStub()
    {
        return [
            'user_id' => $this->fake->numberBetween(1,10),
            'fact' => $this->fake->paragraph
        ];
    }


}
 