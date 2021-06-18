@extends('layouts.admin')

@section('content')
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Results
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Correct</th>
                                        <th>Incorrect</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($results as $result)
                                        <tr>
                                            <td>{{ $result->id }}</td>
                                            <td>{{ $users->where('id', $result->user_id)->first()->name }}</td>
                                            <td>{{ $result->no_correct }}</td>
                                            <td>{{ $result->no_incorrect }}</td>
                                            <td>{{ $result->score }}</td>
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
