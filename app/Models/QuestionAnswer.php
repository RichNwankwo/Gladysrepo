<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class QuestionAnswer extends Model{

    protected $table = 'question_answer';
    protected $fillable = ['question_id', 'answer', 'checked'];

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

} 