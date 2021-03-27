<?php

namespace App;

use App\Quiz;
use App\Answer;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question','quiz_id'];

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function quiz(){
        return $this->belongTo(Quiz::class);
    }
}
