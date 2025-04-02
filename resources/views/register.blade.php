<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
      
                      <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>
                        @if (session('success'))
                        <p style="color: green;">{{ session('success') }}</p>
                        @endif
                      
                        {{-- @if($errors->has('register_error'))
                        <p style="color: red;">{{$errors->first('register_error')}}</p>
                        @endif --}}
                      <form class="mx-1 mx-md-4" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" >
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                          </div>
                        </div>


                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="{{old('email')}}" class="form-control">
                            @error('email')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control">
                            @error('password')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label for="password_confirmation">Confirm Password:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                            @error('password_confirmation')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label for="role">Role:</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label for="about">About:</label>
                            <input type="text" id="about" name="about" class="form-control">
                            @error('about')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label for="phone">Phone:</label>
                            <input type="number" id="phone" name="phone" class="form-control">
                            @error('phone')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                          </div>
                        </div>


                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label for="designation">Designation:</label>
                            <select id="designation" name="designation" class="form-control">
                              <option value="frontend devloper">Frontend Developer</option>
                              <option value="backend devloper">Backend Developer</option>
                              <option value="full stack devloper">Full Stack Developer</option>
                              <option value="software tester">Software Tester</option>
                              <option value="project manager">Project Manager</option>
                              <option value="bussiness administrator">Bussiness Administrator</option>
                            </select>
                            @error('designation')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label for="specialization">Specialization:</label>
                            <select id="specialization" name="specialization" class="form-control">
                              <option value="PHP">PHP</option>
                              <option value="laravel">Laravel</option>
                              <option value="react">React</option>
                              <option value="mongodb">MongoDB</option>
                              <option value="testing">Testing</option>
                              <option value="custom php">Custom PHP</option>
                            </select>
                            @error('specialization')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div data-mdb-input-init class="form-outline flex-fill mb-0">
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address" class="form-control">
                            @error('address')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                            <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                <label for="profile_photo">Profile Photo:</label>
                                <input type="file" id="profile_photo" name="profile_photo" value="profile_photo" class="form-control" >
                                @error('profile_photo')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>                       
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">You have an account? 
                            <a href="{{route('login')}}" class="link-danger">Login</a>
                            </p>
                        </div>
                      </form>
      
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
      
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                        class="img-fluid" alt="Sample image">
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</body>
</html>
