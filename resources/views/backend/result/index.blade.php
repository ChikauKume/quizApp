@extends('backend.layouts.master')

    @section('title','exam assigned user')
        
    @section('content')
    <div class="span9">
        <div class="content">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="module">
                <div class="module-head">
                    <h3>User Exam</h3>
                </div>
                <div class="module-body">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Quiz</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if (count($quizzes))
                                @foreach ($quizzes as $quiz)
                                    @foreach ($quiz->users as $key=>$user)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $quiz->name }}</td>
                                            <td>
                                                <a href="{{ route('quiz.question',[$quiz->id]) }}">
                                                    <button class="btn btn-inverse">View Result</button>  
                                                </a>
                                            </td>
                                            <td>
                                                <a href="result/{{ $user->id }}/{{ $quiz->id }}">
                                                    <button class="btn btn-primary">View Result</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @else
                                <td>No quiz to display</td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
