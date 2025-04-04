@extends('layouts.app')
@section('content')
 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">

      <div class="page-title">
        <div class="title_left">
          <h3>Inbox Design <small>Some examples to get you started</small></h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5   form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Inbox Design<small>User Mail</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Settings 1</a>
                      <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="row">
                <div class="col-sm-3 mail_list_column">
                  <button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button>
                  <a href="#">
                    <div class="mail_list">
                      <div class="left">
                        <i class="fa fa-circle"></i> <i class="fa fa-edit"></i>
                      </div>
                      <div class="right">
                        <h3>Dennis Mugo <small>3.00 PM</small></h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                      </div>
                    </div>
                  </a>
                  <a href="#">
                    <div class="mail_list">
                      <div class="left">
                        <i class="fa fa-star"></i>
                      </div>
                      <div class="right">
                        <h3>Jane Nobert <small>4.09 PM</small></h3>
                        <p><span class="badge">To</span> Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                      </div>
                    </div>
                  </a>
                  <a href="#">
                    <div class="mail_list">
                      <div class="left">
                        <i class="fa fa-circle-o"></i><i class="fa fa-paperclip"></i>
                      </div>
                      <div class="right">
                        <h3>Musimbi Anne <small>4.09 PM</small></h3>
                        <p><span class="badge">CC</span> Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                      </div>
                    </div>
                  </a>
                  <a href="#">
                    <div class="mail_list">
                      <div class="left">
                        <i class="fa fa-paperclip"></i>
                      </div>
                      <div class="right">
                        <h3>Jon Dibbs <small>4.09 PM</small></h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                      </div>
                    </div>
                  </a>
                  <a href="#">
                    <div class="mail_list">
                      <div class="left">
                        .
                      </div>
                      <div class="right">
                        <h3>Debbis & Raymond <small>4.09 PM</small></h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                      </div>
                    </div>
                  </a>
                  <a href="#">
                    <div class="mail_list">
                      <div class="left">
                        .
                      </div>
                      <div class="right">
                        <h3>Debbis & Raymond <small>4.09 PM</small></h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                      </div>
                    </div>
                  </a>
                  <a href="#">
                    <div class="mail_list">
                      <div class="left">
                        <i class="fa fa-circle"></i> <i class="fa fa-edit"></i>
                      </div>
                      <div class="right">
                        <h3>Dennis Mugo <small>3.00 PM</small></h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                      </div>
                    </div>
                  </a>
                  <a href="#">
                    <div class="mail_list">
                      <div class="left">
                        <i class="fa fa-star"></i>
                      </div>
                      <div class="right">
                        <h3>Jane Nobert <small>4.09 PM</small></h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                      </div>
                    </div>
                  </a>
                </div>
                <!-- /MAIL LIST -->

                <!-- CONTENT MAIL -->
                <div class="col-sm-9 mail_view">
                  <div class="inbox-body">
                    <div class="mail_heading row">
                      <div class="col-md-8">
                        <div class="btn-group">
                          <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                          <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                          <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                          <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </div>
                      <div class="col-md-4 text-right">
                        <p class="date"> 8:02 PM 12 FEB 2014</p>
                      </div>
                      <div class="col-md-12">
                        <h4> Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci. Donec ultrices faucibus rutrum.</h4>
                      </div>
                    </div>
                    <div class="sender-info">
                      <div class="row">
                        <div class="col-md-12">
                          <strong>Jon Doe</strong>
                          <span>(jon.doe@gmail.com)</span> to
                          <strong>me</strong>
                          <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="view-mail">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                      <p>Riusmod tempor incididunt ut labor erem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim id est laborum.</p>
                      <p>Modesed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                    <div class="attachment">
                      <p>
                        <span><i class="fa fa-paperclip"></i> 3 attachments — </span>
                        <a href="#">Download all attachments</a> |
                        <a href="#">View all images</a>
                      </p>
                      <ul>
                        <li>
                          <a href="#" class="atch-thumb">
                            <img src="{{asset('assets/images/inbox.png')}}" alt="img" />
                          </a>

                          <div class="file-name">
                            image-name.jpg
                          </div>
                          <span>12KB</span>


                          <div class="links">
                            <a href="#">View</a> -
                            <a href="#">Download</a>
                          </div>
                        </li>

                        <li>
                          <a href="#" class="atch-thumb">
                            <img src="{{asset('assets/images/inbox.png')}}" alt="img" />
                          </a>

                          <div class="file-name">
                            img_name.jpg
                          </div>
                          <span>40KB</span>

                          <div class="links">
                            <a href="#">View</a> -
                            <a href="#">Download</a>
                          </div>
                        </li>
                        <li>
                          <a href="#" class="atch-thumb">
                            <img src="{{asset('assets/images/inbox.png')}}" alt="img" />
                          </a>

                          <div class="file-name">
                            img_name.jpg
                          </div>
                          <span>30KB</span>

                          <div class="links">
                            <a href="#">View</a> -
                            <a href="#">Download</a>
                          </div>
                        </li>

                      </ul>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                      <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                      <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                      <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                    </div>
                  </div>

                </div>
                <!-- /CONTENT MAIL -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

@endsection