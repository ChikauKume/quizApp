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
                    <h3>All Questions</h3>
                </div>
                <div class="module-body">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Question</th>
                            <th>Quiz</th>
                            <th>Created</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @if (count($questions)>0)
                                @foreach ($questions as $key => $question)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $question->question }}</td>
                                        <td>{{ $question->quiz->name }}</td>
                                        <td>{{ date('F d,Y',strtotime($question->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('question.show',[$question->id]) }}">
                                                <button class="btn btn-info">View</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('question.edit',[$question->id]) }}">
                                                <button class="btn btn-primary">Edit</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form class="delete-form{{ $question->id }}" action="{{ route('question.destroy', [$question->id]) }}" method="POST">
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
                    <div class="pagination pagination-centered">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
