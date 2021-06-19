@extends('layouts.admin')

@section('content')
    <div>
        <div class="container" style="padding: 30px 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Edit Quize

                            <a href="{{ route('quizzes.index') }}" class="btn btn-success float-right">
                                All Quizzes
                            </a>
                        </div>

                        <div class="card-body">
                            <form method="post" action="{{ route('quizzes.update', ['quiz' => $quiz->id]) }}"
                                class="form-horizontal">
                                @csrf
                                @method('patch')

                                <div class="form-group">
                                    <label for="name" class="col-md-8 control-label">Name</label>
                                    <div class="col-md-8">
                                        <input name="name" value="{{ $quiz->name }}" type="text" placeholder="name"
                                            class="form-control input-md">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-md-8 control-label">Start Time</label>
                                    <div class="col-md-8">
                                        <input type='text' name="start_time" value="{{ $quiz->start_time }}"
                                            class="form-control input-md" id='datetimepicker' />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-md-8 control-label">End Time</label>
                                    <div class="col-md-8">
                                        <input type='text' name="end_time" value="{{ $quiz->end_time }}"
                                            class="form-control input-md" id='datetimepicker1' />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-md-8 control-label">Duration</label>
                                    <div class="col-md-8">
                                        <input name="total_time" value="{{ $quiz->total_time }}" type="text"
                                            placeholder="duration" class="form-control input-md">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-md-8 control-label">No of Question</label>
                                    <div class="col-md-8">
                                        <input name="no_of_question" value="{{ $quiz->no_of_question }}" type="text"
                                            placeholder="no of question" class="form-control input-md">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-md-8 control-label"></label>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>

                                @include('layouts.errors')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
