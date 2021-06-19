@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Result For - {{ $result->quiz->name }}

                        <a class="btn btn-primary float-right" href="{{ route('home') }}">Back</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Correct</th>
                                        <th>Incorrect</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>{{ Auth::user()->name }}</td>
                                        <td>{{ $result->no_correct }}</td>
                                        <td>{{ $result->no_incorrect }}</td>
                                        <td>{{ $result->score }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
