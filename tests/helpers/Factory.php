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

    /**
     * Creates a related model
     * @param $type The model class
     * @param $method the related model method
     * @param $related_model the related model object
     */
    protected function makeRelatedModel($type, $method, $related_model)
    {
        $this->make($type);
        $model = $type::find(1);
        if(is_array($related_model))
        {
            $model->$method()->saveMany($related_model);
        }
        else
        {
            $model->$method()->save($related_model);
        }


    }

    /**
     * Abstract function to get a mock object
     */
    protected  function getStub()
    {
        throw new BadMethodCallException('Create your own getStub method to declare your fields');
    }




} 