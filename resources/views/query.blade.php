@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="card-header">
                            <h2>Add Your Query</h2>
                            @if (session('success'))
                            <p style="color: rgb(17, 248, 17);">{{ session('success') }}</p>
                            @endif
                            @if ($errors->any())
                            <ul style="color: red;">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="card-body">
                                <form action="{{ route('query.submit') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label for="name" class="control-label">Name:</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ Auth::guard('user')->user()->name }}" readonly>

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label for="email" class="control-label">Email:</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ Auth::guard('user')->user()->email }}" readonly>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-4">
                                        <label for="query" class="control-label">Your Query:</label>
                                        <input type="text" id="query" name="query" class="form-control" placeholder="please enter your query">
                                        @error('query')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="row justify-content-end">
                                        <button type="submit" class="btn btn-success mb-2">Submit</button>
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