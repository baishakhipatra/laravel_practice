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
                                <form action="{{ request()->is('admin/*') ? route('admin.profile.update') : route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    <div>
                                        <div class="form-group mb-4">
                                            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Name:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="name" name="name" class="form-control"
                                                    value="{{ old('name', $user->name) }}" >
                                                @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="email" id="email" name="email" class="form-control"
                                                    value="{{ old('email', $user->email) }}">
                                                    @error('email')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="about" class="control-label col-md-3 col-sm-3 col-xs-12">About:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="about" name="about" class="form-control"
                                                    value="{{ old('about', $user->about) }}">
                                                    @error('about')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="phone" class="control-label col-md-3 col-sm-3 col-xs-12">Phone:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="number" id="phone" name="phone" class="form-control"
                                                    value="{{ old('phone', $user->phone) }}">
                                                    @error('phone')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="designation" class="control-label col-md-3 col-sm-3 col-xs-12">Designation:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="designation" name="designation" class="form-control"
                                                    value="{{ old('designation', $user->designation) }}">
                                                    @error('designation')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="specialization" class="control-label col-md-3 col-sm-3 col-xs-12">Specialization:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="specialization" name="specialization" class="form-control"
                                                    value="{{ old('specialization', $user->specialization) }}">
                                                    @error('specialization')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Address:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="address" id="address" name="address" class="form-control"
                                                    value="{{ old('address', $user->address) }}">
                                                    @error('address')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="profile_photo_url"
                                                class="control-label col-md-3 col-sm-3 col-xs-12">Profile Photo:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="file" id="profile_photo_url" name="profile_photo_url"
                                                    class="form-control" value="{{ old('profile_photo_url', $user->profile_photo_url) }}">
                                                @if ($user->profile_photo_url)
                                                <div class="mt-2">
                                                    <img src="{{ asset($user->profile_photo_url) }}" alt="Profile Photo"
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
                                        <a href="{{ Auth::guard('web')->check() ? route('admin.password.update.form') : route('user.password.update.form') }}" class="btn btn-success">Update Password</a>
                                    </div>
                                    <div class="row justify-content-end">
                                        <a href="{{Auth::guard('web')->check() ? route('index'): route('profiles')}}" class="btn btn-danger">Back</a>
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