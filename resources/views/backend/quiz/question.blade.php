@extends('backend.layouts.master')

@section('title','create quiz')

@section('content')
<div class="span9">
    <div class="content">
        @foreach ($quizzes as $quiz)
            <div class="module">
                <div class="module-head">
                    <h3>{{ $quiz->name }}</h3>
                </div>
                <div class="module-body">
                <p><h3  class="heading">{{ $quiz->name }}</h3></p>
                    <div class="module-body table">
                        @foreach ($quiz->questions as $que)
                            <table class="table table-message">
                                <tbody>
                                        <tr class="read">
                                            {{ $que->question }}

                                            <td class="cell-author hidden-phone hidden-tablet">
                                                @foreach ($que->answers as $answer)
                                                    <p>
                                                        {{ $answer->answer }}
                                                        @if ($answer->is_correct)
                                                        <span class="badge badge-success">correct answer</span>
                                                        @endif
                                                    </p>
                                                @endforeach
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        @endforeach
                    </div>

                    <div class="module-foot">
                        <a href="{{ route('question.index') }}">
                            <button class="btn btn-inverse">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div> 
</div> 
</div> 
@endsection