@extends('layouts.app')
@section('content')

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        
        <div class="title_left">
          <h3>User Profile</h3>
        </div>

      </div>
      
      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              {{-- <h2>User Report <small>Activity report</small></h2> --}}
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="col-md-3 col-sm-3  profile_left">
                <div class="profile_img">
                  <div id="crop-avatar">
                    <!-- Current avatar -->
                    <img class="img-responsive avatar-view" src="{{ asset($user->profile_photo_url) }}" alt="Avatar" title="Change the avatar" width="180" height="180">
                  </div>
                </div>
                <h3>{{$user->name}}</h3>
                <h4><b>{{$user->designation}}</b></h4>
                <h4>{{$user->about}}</h4>

                <ul class="list-unstyled user_data">

                  <li>
                    <i class="fa-solid fa-heart user-profile-icon"></i> {{$user->specialization}}
                  </li>

                  <li><i class="fa fa-map-marker user-profile-icon"></i> {{$user->address}}
                  </li>

                  <li>
                    <i class="fa fa-envelope user-profile-icon"></i> {{$user->email}}
                  </li>

                  <li class="m-top-xs">
                    <i class="fa fa-phone user-profile-icon"></i> {{$user->phone}}
                  </li>
                </ul>

                <!-- start skills -->
                <h4>Skills</h4>
                <ul class="list-unstyled user_data">
                  <li>
                    <p>Web Applications</p>
                    <div class="progress progress_sm">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                    </div>
                  </li>
                  <li>
                    <p>Website Design</p>
                    <div class="progress progress_sm">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                    </div>
                  </li>
                  <li>
                    <p>Automation & Testing</p>
                    <div class="progress progress_sm">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                    </div>
                  </li>
                  <li>
                    <p>UI / UX</p>
                    <div class="progress progress_sm">
                      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                    </div>
                  </li>
                </ul>
                <!-- end of skills -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
 </div>
  <!-- /page content -->

@endsection