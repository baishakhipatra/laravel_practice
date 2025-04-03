@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_pannel">
                        <div class="card-header">
                            <h2>My Team Members</h2>
                            <div class="clearfix"></div>
                            <div class="x_content">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teamMembers as $member)
                                            <tr>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->designation }}</td>
                                            </tr>
                                        @endforeach
                                        <div class="text-right">
                                          <a href="{{route('profiles')}}" class="btn btn-danger">Back</a>
                                        </div>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection