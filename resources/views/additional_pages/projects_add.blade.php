@extends('layouts.app')
@section('content')


<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="card-header">
                            <h2>Update Password</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="card-body">
                                <form action="{{ route('project.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group mb-4">
                                        <label for="project_name" class="control-label">Project Name:</label>
                                        <input type="text" id="project_name" name="project_name" class="form-control" placeholder="please enter your project name" value="{{old('project_name')}}">
                                        @error('project_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-4">
                                        <label for="project_details" class="control-label">Project Details:</label>
                                        <input type="text" id="project_details" name="project_details" class="form-control" placeholder="please enter your project details" value="{{old('project_details')}}">
                                        @error('project_details')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    
                                    <div class="form-group mb-4">
                                        <label for="language_used">Multi Language:</label>
                                        <select id="language_used" name="language_used" class="form-control" value="{{old('language_used')}}">
                                            <option value="laravel">Laravel</option>
                                            <option value="php">PHP</option>
                                            <option value="html">HTML</option>
                                            <option value="css">CSS</option>
                                            <option value="custom_php">Custom PHP</option>
                                            <option value="codignitor">Codignitor</option>
                                            <option value="javascript">Javascript</option>
                                            <option value="ajax">Ajax</option>
                                            <option value="jquery">Jquery</option>
                                        </select>
                                        @error('language_used')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-4">
                                        <label for="team_members" class="control-label">Team Members:</label>
                                        <input type="text" id="team_members" name="team_members" class="form-control" placeholder="please enter your team members" value="{{old('team_members')}}">
                                        @error('team_members')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="project_progress" class="control-label">Project Progress:</label>
                                        <input type="range" id="project_progress" name="project_progress" class="form-control" min="0" max="100" step="1" value="0" oninput="updateProgressBar(this.value)">
                                        
                                        <div class="progress mt-2" style="height: 20px;">
                                            <div id="progress_bar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                                                style="width: 0%;">
                                            </div>
                                        </div>
                                    
                                        <p class="mt-2"><span id="progress_value">0</span>% Complete</p>
                                    
                                        @error('project_progress')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-4">
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="success">Success</option>
                                            <option value="pending">Pending</option>
                                        </select>                                        
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Project</button>
                                    <a href="{{route('projects')}}" class="btn btn-danger btn-sm">Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function updateProgressBar(value) {
        document.getElementById("progress_bar").style.width = value + "%";
        document.getElementById("progress_value").innerText = value;
    }
</script>

@endsection