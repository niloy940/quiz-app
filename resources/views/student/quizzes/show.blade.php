@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ $quiz->name }}

                        <div class="float-right">
                            time
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('student.answers') }}">
                            @csrf

                            @foreach ($quiz->questions as $question)
                                <h5>{{ $question->question }}</h5>

                                @foreach ($question->answers as $answer)
                                    <div class="form-check">
                                        <input class="form-check-input" name="answers[]" type="checkbox"
                                            value="{{ $answer->id }}" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $answer->answer }}
                                        </label>
                                    </div>
                                @endforeach
                                <br>
                            @endforeach

                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
