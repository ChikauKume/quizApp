<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        $questions = $question->getQuestions();
        return view('backend.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Question $que, Answer $ans)
    {
        $data = $this->validateForm($request);
        $question = $que->storeQuestion($data);
        $answer = $ans->storeAnswer($data,$question);
        return redirect()->route('question.create')
        ->with('message','Question created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $que, $id)
    {
        $question = $que->getQuestionById($id);
        return view('backend.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $que, $id)
    {
        $question = $que->getQuestionById($id);
        return view('backend.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Question $que, Answer $ans, Request $request, $id)
    {
        $data = $this->validateForm($request);
        $question = $que->updateQuestion($id, $request);
        $answer = $ans->updateAnswer($request, $question);

        return redirect()->route('question.show', $id)->with('messsage', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $que, Answer $ans, $id)
    {
        $ans->deleteAnswer($id);
        $que->deleteQuestion($id);

        return redirect()->route('question.index')->with('message', 'Deleted the question successfully');
    }

    public function validateForm($request){
        return $this->validate($request,[
            'quiz' => 'required',
            'question' => 'required|min:3',
            'options' => 'bail|required|array|min:3',
            'options.*' => 'bail|required|string|distinct',
            'correct_answer' => 'required'
        ]);
    }
}
