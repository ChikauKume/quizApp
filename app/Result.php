<?php

namespace App;

use App\Answer;
use App\Question;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['user_id','answer_id','quiz_id','question_id'];

    public function question(){
        return $this->belongTo(Question::class);
    }

    public function answer(){
        return $this->belongTo(Answer::class);
    }
}
