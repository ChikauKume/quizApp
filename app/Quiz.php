<?php

namespace App;

use App\Quiz;
use App\Question;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['name','description','minutes'];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function storeQuiz($data){
        return Quiz::create($data);
    }

    public function allQuiz(){
         return Quiz::all();
    }

    public function getQuizById($id){
        return Quiz::find($id);
    }

    public function updateQuiz($id,$data){
        return Quiz::find($id)->fill($data)->save();
    }

    public function deleteQuiz($id){
        return Quiz::find($id)->delete();
    }

    public function bindQuestions($id){
      return Quiz::where('id',$id)->with('questions')->get();
    }
}
