@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Quizzes</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @elseif(session('not-started'))
                            <div class="alert alert-success" role="alert">
                                {{ session('not-started') }}
                            </div>
                        @elseif(session('time-over'))
                            <div class="alert alert-success" role="alert">
                                {{ session('time-over') }}
                            </div>
                        @endif

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Duration</th>
                                    <th>Total Question</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($quizzes as $key => $quiz)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $quiz->name }}</td>
                                        <td>{{ $quiz->start_time->format('Y-m-d h:i A') }}</td>
                                        <td>{{ $quiz->end_time->format('Y-m-d h:i A') }}</td>
                                        <td>{{ $quiz->total_time }} minutes</td>
                                        <td>{{ $quiz->no_of_question }}</td>
                                        <td>
                                            @if (!App\Models\Result::where('quiz_id', $quiz->id)->exists())
                                                <a class="btn btn-primary"
                                                    href="{{ route('student.quiz', ['quiz' => $quiz->id]) }}">
                                                    Start Now
                                                </a>
                                            @else
                                                <a class="btn btn-success"
                                                    href="{{ route('student.result', ['quiz' => $quiz->id, 'user' => Auth::user()->id]) }}">
                                                    Get Result
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
