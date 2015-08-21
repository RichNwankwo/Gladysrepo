<?php


class testPracticeSessionToolbox extends TestCase{

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }



} 