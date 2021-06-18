@extends('layouts.admin')

@section('content')
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Quizzes

                        <a href="{{ route('quizzes.create') }}" class="btn btn-success float-right">
                            Add New Quize
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Sart</th>
                                        <th>End</th>
                                        <th>Duration</th>
                                        <th>Question</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($quizzes as $quiz)
                                        <tr>
                                            <td>{{ $quiz->id }}</td>
                                            <td>
                                                <a href="{{ route('quizzes.show', ['quiz' => $quiz->id]) }}">
                                                    {{ $quiz->name }}
                                                </a>
                                            </td>
                                            <td>{{ $quiz->start_time->format('Y-m-d h:i A') }}</td>
                                            <td>{{ $quiz->end_time->format('Y-m-d h:i A') }}</td>
                                            <td>{{ $quiz->total_time }} minutes</td>
                                            <td>{{ $quiz->no_of_question }}</td>

                                            <td>
                                                <form method="post"
                                                    action="{{ route('quizzes.destroy', ['quiz' => $quiz->id]) }}">
                                                    @csrf
                                                    @method('delete')

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
@endsection
