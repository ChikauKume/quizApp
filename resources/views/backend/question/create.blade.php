@extends('backend.layouts.master')

    @section('title','create question')
        
    @section('content')
    <div class="span9">
        <div class="content">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            <form action="{{ route('question.store') }}" method="POST">
                @csrf
                <div class="module">
                    <div class="module-name">
                        <h3>Create question</h3>
                    </div>
                    <div class="module-body">
                        <div class="control-group">
                            <label class="control-label">Choose Quiz</label>
                            <div class="controls">
                                <select name="quiz" class="span8">
                                    @foreach (App\Quiz::all() as $quiz)
                                        <option value="{{ $quiz->id }}">
                                            {{ $quiz->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <label class="control-label">Options</label>
                                <div class="controls">
                                    @for($i=0; $i<4; $i++)
                                        <input type="text" name="options[]" class="span7 @error('options') border-red @enderror" placeholder="options{{ $i+1 }}" 
                                        value="{{ $i }}"
                                        required="">

                                        <input type="radio" name="correct_answer" value="{{ $i }}">
                                        <span>Is correct answer ?</span>
                                    @endfor
                                </div>
                                @error('description')
                                    <span class="invalid-feedeback alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="control-group">
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
