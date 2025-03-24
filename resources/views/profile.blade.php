@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="card-header">
                            <h2>Update Profile</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    <div>
                                        <div class="form-group mb-4">
                                            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Name:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="name" name="name" class="form-control"
                                                    value="{{ Auth::user()->name }}" required>
                                                @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="email" id="email" name="email" class="form-control"
                                                    value="{{ Auth::user()->email }}" required>
                                                    @error('email')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="profile_photo_url"
                                                class="control-label col-md-3 col-sm-3 col-xs-12">Profile Photo:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="file" id="profile_photo_url" name="profile_photo_url"
                                                    class="form-control">
                                                @if (Auth::user()->profile_photo_url)
                                                <div class="mt-2">
                                                    <img src="{{ asset(Auth::user()->profile_photo_url) }}" alt="Profile Photo"
                                                        class="img-thumbnail" width="100">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <button type="submit" class="btn btn-success mb-2">Update Profile</button>
                                    </div>
                                    <div class="row justify-content-end">
                                        <a href="{{ route('password.update.form') }}" class="btn btn-success">Update Password</a>
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