@extends('layouts.admin')

@section('content')
    <div>
        <div class="container" style="padding: 30px 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Add New Answer

                            <a href="{{ route('questions.show', ['quiz' => $quiz->id, 'question' => $question->id]) }}"
                                class="btn btn-success float-right">
                                All Answers
                            </a>
                        </div>

                        <div class="card-body">
                            <form method="post"
                                action="{{ route('answers.store', ['quiz' => $quiz->id, 'question' => $question->id]) }}"
                                class="form-horizontal">
                                @csrf

                                <div class="form-group">
                                    <label for="name" class="col-md-8 control-label">Answer</label>
                                    <div class="col-md-8">
                                        <input name="answer" type="text" placeholder="answer" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-md-8 control-label">Is Correct?</label>
                                    <div class="col-md-8">
                                        <select name="is_correct">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
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
