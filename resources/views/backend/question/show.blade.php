@extends('backend.layouts.master')

	@section('title','create quiz')

	@section('content')
				<div class="span9">
                    <div class="content">
                    	
                        <div class="module">
                            <div class="module-head">
                            </div>
                            <div class="module-body">
                            <p><h3  class="heading">{{ $question->question }}</h3></p>
                                <div class="module-body table">
                                    <table class="table table-message">
                                        <tbody>
                                            @foreach ($question->answers as $answer)
                                                <tr class="read">
                                                    <td class="cell-author hidden-phone hidden-tablet">
                                                        {{ $answer->answer }}
                                                        @if ($answer->is_correct)
                                                            <span class="badge badge-success pull-right">correct</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="module-foot">
                                    <a href="{{ route('question.edit',[$question->id]) }}">
                                        <button class="btn btn-primary">Edit</button>
                                    </a>
                                    <form class="delete-form{{ $question->id }}" action="{{ route('question.destroy', [$question->id]) }}" method="POST">
                                        @csrf
                                        {{ method_field("DELETE") }}
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                    </form>
                                    <a href="{{ route('question.index') }}">
                                        <button class="btn btn-inverse">Back</button>
                                    </a>
                                </div>
                            </div>
                   		</div>
           			</div>
        		</div> 
            </div> 
        </div> 
@endsection