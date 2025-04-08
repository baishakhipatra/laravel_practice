@extends('layouts.app')
@section('content')


<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="card-header">
                            <h2> Create Team for {{$teamLead->name}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        @if(session()->has('success'))
                            <div style="color: green; font-weight: bold;">{{ session('success') }}</div>
                        @endif

                        @if(session()->has('error'))
                            <div style="color: red; font-weight: bold;">{{ session('error') }}</div>
                        @endif

                        <div class="x_content">
                            <div class="card-body">
                                <form action="{{ route('team.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="team_lead_id" value="{{ $teamLead->id }}">
                        
                                    <div class="form-group mb-3">
                                        <label for="team_name"><strong>Team Name:</strong></label>
                                        <input type="text" name="team_name" class="form-control" placeholder="Enter Team Name" required>
                                    </div>
                        
                                    <div class="form-group mb-3">
                                        <label><strong>Team Lead:</strong></label>
                                        <input type="text" class="form-control" value="{{ $teamLead->name }}" disabled>
                                    </div>
                        
                                    <div class="form-group mb-3">
                                        <label><strong>Select Team Members:</strong></label>
                                        <select name="team_members[]" class="form-control select2" multiple required>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->designation }}</option>
                                            @endforeach
                                        </select>                                        
                                        {{-- <small class="text-muted">Hold 'Ctrl' (Windows) to select multiple users.</small> --}}
                                    </div>
                        
                                    <button type="submit" class="btn btn-success">Create Team</button>
                                    <a href="{{ route('profiles') }}" class="btn btn-danger">Back</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select team members",
            width: '100%'
        });
    });
</script>
@endsection


