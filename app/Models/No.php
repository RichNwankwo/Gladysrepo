<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class No extends Model{

    protected $table = 'no';
    protected $fillable = ['user_id', 'description'];

    public function user()
    {
        // Each no belongs to a user
        return $this->belongsTo('App\Models\User');
    }


} 