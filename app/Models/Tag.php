<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model{

    protected $table = 'tag';
    protected $fillable = ['tag'];

    public function facts()
    {
        // Creating the relationship between tags and facts
        return $this->belongsToMany('App\Models\Fact', 'facts_tags');
    }

    public function taggedFacts()
    {
        return $this->hasMany('App\Models\TaggedFact');
    }


} 