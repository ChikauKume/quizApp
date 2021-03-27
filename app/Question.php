<?php

namespace App;

use App\Quiz;
use App\Answer;
use App\Question;
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

    public function storeQuestion($data){
        return Question::create($data);
    }

    public function allQuestion(){
        return Question::all();
    }

    public function getQuestionById($id){
        return Question::find($id);
    }

    public function updateQuestion($id,$data){
        return Question::find($id)->fill($data)->save();
    }

    public function deleteQuestion($id){
        return Question::find($id)->delete();
    }
}
