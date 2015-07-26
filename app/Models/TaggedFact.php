<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Fact;



class TaggedFact extends Model{

    protected $fillable = ['fact_id', 'tag_id'];

    protected $table = 'facts_tags';

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }

    public function fact()
    {
        return $this->belongsTo('App\Models\Fact');
    }
} 