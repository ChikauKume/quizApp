@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if ($isExamAssigned)
                @foreach ($quizzes as $quiz)
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            {{-- <example-component></example-component> --}}
                            <p><h3>{{ $quiz->name }}</h3></p>
                            <p>About Exam : {{ $quiz->description }}</p>
                            <p>Time allocated : {{ $quiz->minutes }}</p>
                            <p>Number of questions : {{ $quiz->questions->count() }}</p>
                            <p>
                                @if (!in_array($quiz->id,$wasQuizCompleted))
                                    <a href="user/quiz/{{ $quiz->id }}">
                                        <button class="btn btn-success">Start Quiz</button>
                                    </a>
                                @else
                                    <a href="/result/user/{{ Auth::user()->id }}/quiz/{{ $quiz->id }}">View Result</a>
                                    <span class="float-right">Completed</span>
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <p>You have not assigned any exam</p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">User Profile</div>
                <div class="card-body">
                    <p>Email : {{ auth()->user()->email }}</p>
                    <p>Occupation : {{ auth()->user()->occupation }}</p>
                    <p>Address : {{ auth()->user()->address }}</p>
                    <p>Phone : {{ auth()->user()->phone }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
