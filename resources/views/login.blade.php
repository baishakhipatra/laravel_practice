<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-10 col-xl-9">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="row g-0">
              <div class="col-md-6 d-flex align-items-center order-2 order-lg-1">
                <div class="card-body p-4 p-lg-5">
                  @if ($errors->has('login_error'))
                    <p style="color: red;">{{ $errors->first('login_error') }}</p>
                  @endif
                  <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-outline mb-4">
                      <input type="email" id="email" name="email" class="form-control form-control-lg"
                        placeholder="Enter a valid email address" value="{{old('email')}}"/>
                      <label class="form-label" for="email">Email address</label>
                      @error('email')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-outline mb-3">
                      <input type="password" id="password" name="password" class="form-control form-control-lg"
                        placeholder="Enter password"/>
                      <label class="form-label" for="password">Password</label>
                      @error('password')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                      <a href="{{route('forget.password.form')}}" class="text-body">Forgot password?</a>
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                      <button type="submit" class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                      <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? 
                        <a href="{{route('register')}}" class="link-danger">Register</a>
                      </p>
                    </div>
                  </form>
                </div>
              </div>

              <div class="col-md-6 order-1 order-lg-2 d-flex align-items-center">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
