<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fact extends Model {

    protected $table = "fact";
    protected $fillable = ['user_id', 'fact'];


    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'facts_tags');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function taggedFact()
    {
        return $this->hasMany('App\Models\TaggedFact');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
} 