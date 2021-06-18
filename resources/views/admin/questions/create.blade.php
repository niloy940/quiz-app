@extends('layouts.admin')

@section('content')
    <div>
        <div class="container" style="padding: 30px 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Add New Question

                            <a href="{{ route('quizzes.show', ['quiz' => $quiz->id]) }}"
                                class="btn btn-success float-right">
                                All Questions
                            </a>
                        </div>

                        <div class="card-body">
                            <form method="post" action="{{ route('questions.store', ['quiz' => $quiz->id]) }}"
                                class="form-horizontal">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="col-md-8 control-label">Question</label>
                                    <div class="col-md-8">
                                        <input name="question" type="text" placeholder="question" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-md-8 control-label"></label>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
