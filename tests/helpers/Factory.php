<?php
use Faker\Factory as Faker;
trait Factory {

    protected $times = 1;


    public function times($number)
    {
        $this->times = $number;
        return $this;
    }

    /**
     * Make new record in the DB
     * @param $type
     * @param array $fields
     */
    protected function make($type, array $fields = [])
    {
        while($this->times--)
        {
            $stub = array_merge($this->getStub(), $fields);
            $type::create($stub);

        }
    }

    protected  function getStub()
    {
        throw new BadMethodCallException('Create your own getStub method to declare your fields');
    }


} 