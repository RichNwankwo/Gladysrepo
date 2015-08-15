<?php


namespace App\Models;


class PracticeMaterial extends Model{

    public $timestamps = false;
    public $table = 'practice_session_material';
    protected $fillable = ['session_id','fact_id','question_id', 'answer_id'];

} 