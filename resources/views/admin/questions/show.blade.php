@extends('layouts.admin')

@section('content')
    <div>
        <div class="container" style="padding: 30px 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Question Answers

                            <a href="{{ route('answers.create', ['quiz' => $quiz->id, 'question' => $question->id]) }}"
                                class="btn btn-success float-right">
                                Add Answer
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Answer</th>
                                            <th>Correct</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($question->answers as $answer)
                                            <tr>
                                                <td>{{ $answer->id }}</td>
                                                <td>{{ $answer->answer }}</td>
                                                <td>{{ $answer->is_correct ? 'Yes' : 'No' }}</td>

                                                <td>
                                                    <form method="post"
                                                        action="{{ route('answers.destroy', ['quiz' => $quiz->id, 'question' => $question->id, 'answer' => $answer->id]) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
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
        </div>
    </div>
@endsection
