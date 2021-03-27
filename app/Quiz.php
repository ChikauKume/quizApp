<?php

namespace App;

use App\Question;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['name','description','minutes'];

    public function quesitons(){
        return $this->hasMany(Question::class);
    }
}
