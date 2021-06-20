@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ $quiz->name }}


                        <div class="float-right">
                            <span id="time">{{ $time_left }}</span>
                            minutes left
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('one-ans'))
                            <div class="alert alert-success" role="alert">
                                {{ session('one-ans') }}
                            </div>
                        @endif

                        <form method="post" action="{{ route('student.answers') }}">
                            @csrf

                            @foreach ($quiz->questions as $question)
                                <h5>{{ $question->question }}</h5>

                                @foreach ($question->answers as $answer)
                                    <div class="form-check">
                                        <input class="form-check-input" name="answers[]" type="checkbox"
                                            value="{{ $answer->id }}" id="{{ $question->id }}">
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

<script>
    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
        setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = 0;
            }
        }, 1000);
    }

    window.onload = function() {

        var time = document.getElementById('time').innerHTML;

        var duration = 60 * time,
            display = document.querySelector('#time');
        startTimer(duration, display);
    };

</script>
