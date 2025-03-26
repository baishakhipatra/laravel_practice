<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <div class="card">
        <div class="right_col" role="main">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="card-header">
                                <h2>Forget Password</h2>
                                <div class="clearfix"></div>
                            </div>
                            @if(session('success'))
                             <p style="color: green;">{{ session('success') }}</p>
                            @endif

                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <p style="color: red;">{{ $error }}</p>
                                @endforeach
                            @endif
                            <div class="x_content">
                                <div class="card-body">
                                    <form action="{{ route('forget.password') }}" method="POST" class="form-horizontal">
                                        @csrf 
                                        
                                        <div class="form-group mb-4">
                                            <label for="email" class="control-label">Email:</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="please enter your email">
                                            @error('email')
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
                                            <button type="submit" class="btn btn-success mb-2">Set New Password</button>
                                        </div>
                                        <div class="row justify-content-end">
                                            <a href="{{ route('login') }}" class="btn btn-danger">Back to login</a>
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
</body>
</html>


