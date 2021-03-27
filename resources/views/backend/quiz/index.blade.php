@extends('backend.layouts.master')

    @section('title','create quiz')
        
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
                    <h3>All Quiz</h3>
                </div>
                <div class="module-body">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Minutes</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if (count($quizzes)>0)
                                @foreach ($quizzes as $key => $quiz)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $quiz->name }}</td>
                                        <td>{{ $quiz->description }}</td>
                                        <td>{{ $quiz->minutes }}</td>
                                        <td>
                                            <a href="{{ route('quiz.edit',[$quiz->id]) }}">
                                                <button class="btn btn-primary">Edit</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form class="delete-form{{ $quiz->id }}" action="{{ route('quiz.destroy', [$quiz->id]) }}" method="POST">
                                                @csrf
                                                {{ method_field("DELETE") }}
                                                <input type="submit" value="Delete" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
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
