<?php

namespace App;

use App\Quiz;
use App\Answer;
use App\Question;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question','quiz_id'];
    private $limit = 10;
    private $order = 'DESC';

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function storeQuestion($data){
        $data['quiz_id'] = $data['quiz'];
        return Question::create($data);
    }
   
    public function getQuestionById($id){
        return Question::where('id',$id)->with('answers')->first();
    } 

    public function getQuestions(){
        return Question::orderBy('created_at', $this->order)
        ->with('quiz')->paginate($this->limit);
    }

    public function updateQuestion($id,$data){
        $question = Question::find($id);
        $question->question = $data['question'];
        $question->quiz_id = $data['quiz'];
        $question->save();
        return $question;
    }

    public function deleteQuestion($id){
        return Question::find($id)->delete();
    }
}
