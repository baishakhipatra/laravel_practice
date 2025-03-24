@extends('layouts.app')
@section('content')

{{-- <div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="card-header">
                            <h2>Update Password</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="card-body">
                                <form action="{{ route('password.update') }}" method="POST" class="form-horizontal form-label-left">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label for="current_password" class="control-label col-md-3 col-sm-3 col-xs-12">Current Password:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="password" id="current_password" name="current_password" class="form-control" placeholder="please enter your current password">
                                            @error('current_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">New Password:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="please enter your new password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label for="password_confirmation" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password:</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="please confirm your new password">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row justify-content-end">
                                        <button type="submit" class="btn btn-success mb-2">Update Password</button>
                                    </div>
                                    <div class="row justify-content-end">
                                        <a href="{{ route('profile') }}" class="btn btn-danger">Back to Profile</a>
                                    </div>
                                </form>
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
                    <div class="x_panel">
                        <div class="card-header">
                            <h2>Update Password</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="card-body">
                                <form action="{{ route('password.update') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label for="current_password" class="control-label">Current Password:</label>
                                        <input type="password" id="current_password" name="current_password" class="form-control" placeholder="please enter your current password">
                                        @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label for="password" class="control-label">New Password:</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="please enter your new password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label for="password_confirmation" class="control-label">Confirm Password:</label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="please confirm your new password">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="row justify-content-end">
                                        <button type="submit" class="btn btn-success mb-2">Update Password</button>
                                    </div>
                                    <div class="row justify-content-end">
                                        <a href="{{ route('profile') }}" class="btn btn-danger">Back to Profile</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection