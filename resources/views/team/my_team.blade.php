@extends('layouts.app')
@section('content')

{{-- <div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_pannel">
                        <div class="card-header">
                            <h2>My Team Members</h2>
                            <div class="clearfix"></div>
                            <div class="x_content">
                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                            
                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                            
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($teamMembers->isEmpty())
                                            <tr>
                                                <td colspan="3" class="text-center">No records found</td>
                                            </tr>
                                        @else
                                        @foreach ($teamMembers as $member)
                                            <tr>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->designation }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <div class="text-right">
                                        <a href="{{route('profiles')}}" class="btn btn-danger">Back</a>
                                    </div>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

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

                                {{-- Success/Error Messages --}}
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                
                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                {{-- Team Members Table --}}
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Designation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($teamMembers->isEmpty())
                                            <tr>
                                                <td colspan="3" class="text-center">No records found</td>
                                            </tr>
                                        @else
                                            @foreach ($teamMembers as $member)
                                                <tr>
                                                    <td>{{ $member->name }}</td>
                                                    <td>{{ $member->email }}</td>
                                                    <td>{{ $member->designation }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                                {{-- Back Button --}}
                                <div class="text-right mt-2">
                                    <a href="{{ route('profiles') }}" class="btn btn-danger">Back</a>
                                    <a href="" class="btn btn-primary">Add Team Member</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

