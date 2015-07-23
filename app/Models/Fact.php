<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fact extends Model {

    protected $table = "fact";
    protected $fillable = ['user_id', 'fact'];




} 