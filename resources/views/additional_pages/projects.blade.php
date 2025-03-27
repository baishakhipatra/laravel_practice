@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Projects</h3>
            </div>

            <div class="title_right">
                <div class="col-md-10 col-sm-10 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go!</button>
                        </span>
                        <a href="{{route('project.add')}}" class="btn btn-primary btn-sm">Add project</a>
                    </div>
                    <div>
                        
                    </div>
                </div>
                
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Projects</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- start project list -->
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 1%">No.</th>
                                    <th style="width: 20%">Project Name</th>
                                    <th>Project Details</th>
                                    <th>Languages</th>
                                    <th>Team Members</th>
                                    <th>Project Progress</th>
                                    <th>Status</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $key=> $item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->project_name}}</td>
                                    <td>{{$item->project_details}}</td>
                                    <td>{{ str_replace(',', ', ', $project->language_used) }}</td>
                                    <td>{{$item->team_members}}</td>
                                    {{-- <td>{{$item->project_progress}}</td> --}}
                                    <td style="width: 200px">
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                role="progressbar" style="width: {{ $item->project_progress }}%;"
                                                aria-valuenow="{{ $item->project_progress }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                        <small>{{ $item->project_progress }}% Complete</small>
                                    </td>
                                    {{-- <td>{{$item->status}}</td> --}}
                                    <td>
                                        @if($item->status == 'success')
                                        <span class="badge bg-success text-light">Success</span>
                                        @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="" class="btn btn-success">Edit</a>|
                                        <a href="" class="btn btn-danger">Delete</a>|
                                        <a href="" class="btn btn-success">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- end project list -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection