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
            <form action="{{ route('quiz.update',[$quiz->id]) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="module">
                    <div class="module-name">
                        <h3>Edit quiz</h3>
                    </div>
                    <div class="module-body">
                        <div class="control-group">
                            <label class="control-label">Quiz name</label>
                            <div class="controls">
                                <input type="text" name="name" class="span" 
                                placeholder="name of a quiz" value="{{ $quiz->name }}"><br>
                                @error('name')
                                    <span class="invalid-feedeback alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="controls">
                                <label class="control-label">Quiz Description</label>
                                <textarea name="description" class="span8">{{ $quiz->description }}</textarea><br>
                                @error('description')
                                    <span class="invalid-feedeback alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="controls">
                                <label class="control-label">Minutes</label>
                                <input type="text" name="minutes" class="span" 
                                placeholder="minutes of a quiz" value="{{ $quiz->minutes }}"><br> 
                                @error('minutes')
                                    <span class="invalid-feedeback alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="controls">
                                <button type="submit" class="btn btn-success">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
