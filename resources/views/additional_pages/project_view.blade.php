@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="card-header">
                            <h2>View Project</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="card-body">
                                    <div>
                                        <div class="form-group mb-6">
                                            <label for="project_name" class="control-label col-md-3 col-sm-3 col-xs-12">Project Name:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="project_nam" name="project_nam" class="form-control" value="{{ $project->project_name }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group mb-6">
                                            <label for="project_details" class="control-label col-md-3 col-sm-3 col-xs-12">Project Details:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="project_details" name="project_details" class="form-control" value="{{ $project->project_details }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group mb-6">
                                            <label for="language_used" class="control-label col-md-3 col-sm-3 col-xs-12">Multi Language:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="language_used" name="language_used" class="form-control" value="{{ $project->language_used }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group mb-6">
                                            <label for="team_members" class="control-label col-md-3 col-sm-3 col-xs-12">Team Members:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="number" id="team_members" name="team_members" class="form-control" value="{{ $project->team_members }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group mb-6">
                                            <label for="project_progress" class="control-label col-md-3 col-sm-3 col-xs-12">Project Progress:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="project_progress" name="project_progress" class="form-control" value="{{ $project->project_progress }}%" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group mb-6">
                                            <label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status:</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" id="status" name="status" class="form-control" value="{{ $project->status }}" readonly>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <a href="{{route('projects')}}" class="btn btn-danger mt-2">Back</a>
                                            {{-- <a href="{{route('project.edit.form',$project->id)}}" class="btn btn-success mt-2">Edit</a> --}}
                                        </div>
                                    </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
