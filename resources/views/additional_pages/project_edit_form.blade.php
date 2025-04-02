@extends('layouts.app')
@section('content')
<body>
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
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="x_content">
                                <div class="card-body">
                                    <form action="{{ route('project.update') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="project_name">Project Name</label>
                                            <input type="text" class="form-control" id="project_name" name="project_name" value="{{ old('project_name', $project->project_name) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="project_details">Project Details</label>
                                            <input type="text" class="form-control" id="project_details" name="project_details" value="{{ old('project_details', $project->project_details) }}" required>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="language_used">Multi Language</label>
                                            <input type="text" class="form-control" id="language_used" name="language_used" value="{{ old('language_used', $project->language_used) }}" required>
                                        </div>
                                
                                        <div class="form-group">
                                            <label for="team_members">Team Members</label>
                                            <input type="text" class="form-control" id="team_members" name="team_members" value="{{ old('team_members', $project->team_members) }}" required>
                                        </div>
                                

                                        <div class="form-group mb-4">
                                            <label for="project_progress" class="control-label">Project Progress:</label>
                                            <input type="range" id="project_progress" name="project_progress" class="form-control" min="0" max="100" step="1" value="{{ old('project_progress', $project->project_progress) }}" oninput="updateProgressBar(this.value)">
                                            
                                            <div class="progress mt-2" style="height: 20px;">
                                                <div id="progress_bar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                                                    style="width: {{old('project_progress',$project->project_progress)}};">
                                                </div>
                                            </div>
                                        
                                            <p class="mt-2"><span id="progress_value">{{old('project_progress', $project->project_progress)}}</span>% Complete</p>
                                        </div>
                            

                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="success" {{ old('status', $project->status) == 'success' ? 'selected' : '' }}>Success</option>
                                                <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </div>
                                    
                                        <input type="hidden" name="project_id" value="{{$project->id}}">
                                        
                                        <button type="submit" class="btn btn-primary">Edit Project</button>
                                        <a href="{{route('project.view', $project->id)}}" class="btn btn-danger">Back</a>
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

@endsection

<script>
    function updateProgressBar(value){
        let progressBar = document.getElementById('progress_bar');
        let progressText = document.getElementById('progress_value');

        progressBar.style.width = value + "%";
        progressText.innerText = value;
    }

    document.addEventListener("DOMContentLoaded", function(){
        let progressInput = document.getElementById('project_progress');

        updateProgressBar(progressInput.value);

        progressInput.addEventListener("input", function(){
            updateProgressBar(this.value);
        });
    });
</script>