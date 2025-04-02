@extends('layouts.app')
@section('content')

  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Contacts</h3>
        </div>

        <div class="title_right">
          <div class="col-md-10 col-sm-10  form-group pull-right top_search">
            <form action="{{ route('contacts') }}" method="GET">
              <div class="input-group">
                  <input type="text" class="form-control" name="keyword" value="{{ request('keyword') }}" placeholder="Search for...">
                  <span class="input-group-btn">
                      <button class="btn btn-secondary" type="submit">Go!</button>
                      <a href="{{ url()->current() }}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Clear filter">
                        <i class="fa fa-times"></i>
                      </a>
                  </span>
                </div>
            </form>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
          <div class="x_panel">
            <div class="x_content">
                <div class="clearfix"></div>
              @foreach ($users as $user)
                <div class="col-md-4 col-sm-4  profile_details">
                  <div class="well profile_view">
                    <div class="col-sm-12">
                      <h4 class="brief"><h3>{{$user->name}}</h3>
                      <div class="left col-md-7 col-sm-7">
                        <h2>{{$user->designation}}</h2>
                        <p><strong>About: </strong> {{$user->about ?? 'No Bio Available'}} </p>
                        <p><strong>Specialization: </strong> {{$user->specialization ?? 'No Specialization Available'}} </p>
                        <ul class="list-unstyled">
                          <li><i class="fa fa-envelope"></i>Email: {{$user->email ?? 'N/A'}}</li>
                          <li><i class="fa fa-phone"></i> Phone:{{$user->phone ?? 'N/A'}} </li>
                          <li><i class="fa fa-home"></i> Address:{{$user->address ?? 'N/A'}} </li>
                        </ul>
                      </div>
                      <div class="right col-md-5 col-sm-5 text-center">
                        <img src={{ asset($user->profile_photo_url) }} alt="" class="img-circle img-fluid">
                      </div>
                    </div>
                    <div class=" profile-bottom text-center">
                      <div class=" col-sm-6 emphasis">
                        <p class="ratings">
                          <a>4.0</a>
                          <a href="#"><span class="fa fa-star"></span></a>
                          <a href="#"><span class="fa fa-star"></span></a>
                          <a href="#"><span class="fa fa-star"></span></a>
                          <a href="#"><span class="fa fa-star"></span></a>
                          <a href="#"><span class="fa fa-star-o"></span></a>
                        </p>
                      </div>
                      <div class=" col-sm-6 emphasis">
                        <a href="{{route('admin_chat', $user->id)}}" class="btn btn-primary btn-sm">
                          <i class="fa fa-chat"></i>Chat
                        </a>
                       <a href="{{route('view_profile', $user->id)}}" class="btn btn-primary btn-sm">
                        <i class="fa fa-user"></i> View Profile
                       </a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection