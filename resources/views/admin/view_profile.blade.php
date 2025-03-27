@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="card-header">
                            <h2>View Profile</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="card-body">
                                    <div>
                                        <div class="form-group mb-4">
                                            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Name:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Email:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="name" name="name" class="form-control" value="{{ $user->email }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="profile_photo_url" class="control-label col-md-3 col-sm-3 col-xs-12">Profile Photo:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                @if ($user->profile_photo_url)
                                                    <div class="mt-2">
                                                        <img src="{{ asset($user->profile_photo_url) }}" alt="Profile Photo" class="img-thumbnail" width="100">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
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