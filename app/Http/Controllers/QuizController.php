<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Quiz $quiz)
    {
        $quizzes = $quiz->allQuiz();
        return view('backend.quiz.index',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Quiz $qui, Request $request)
    {
        $data = $this->validateForm($request);
        $quiz = $qui->storeQuiz($data);
        return redirect()->back()->with('message', 'Quiz created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $qui, $id)
    {
        $quiz = $qui->getQuizById($id);
        return view('backend.quiz.edit',compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Quiz $qui,Request $request, $id)
    {
        $data = $this->validateForm($request);
        $quiz = $qui->updateQuiz($id, $data);
        return redirect(route('quiz.index'))->with('message','Quiz updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $qui,$id)
    {
        $qui->deleteQuiz($id);
        return redirect(route('quiz.index'))->with('message','Quiz deleted successfully');
    }

    public function question(Quiz $quiz, $id){
        $quizzes = $quiz->bindQuestions($id);
        return view('backend.quiz.question',compact('quizzes'));
    }

    public function validateForm($req){
        return $this->validate($req,[
            'name' => 'required|string',
            'description' => 'required|min:3|max:500',
            'minutes' => 'required|integer'
        ]);
    }
}
