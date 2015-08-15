<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PracticeSession extends Model{

    protected $table = 'practice_session';
    protected $fillable = ['user_id', 'started_at'];
    public $timestamps = false;

} 