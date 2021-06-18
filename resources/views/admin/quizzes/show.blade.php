@extends('layouts.admin')

@section('content')
    <div>
        <div class="container" style="padding: 30px 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Quiz Questions

                            <a href="{{ route('questions.create', ['quiz' => $quiz->id]) }}"
                                class="btn btn-success float-right">
                                Add Question
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Question</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($quiz->questions as $question)
                                            <tr>
                                                <td>{{ $question->id }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('questions.show', ['quiz' => $quiz->id, 'question' => $question->id]) }}">
                                                        {{ $question->question }}
                                                    </a>
                                                </td>

                                                <td>
                                                    <form
                                                        action="{{ route('questions.destroy', ['quiz' => $quiz->id, 'question' => $question->id]) }}"
                                                        method="post">
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
