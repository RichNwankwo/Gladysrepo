<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Question extends Model{

    protected $table = 'question';
    protected $fillable = ['fact_id', 'question_type', 'question_title'];

} 