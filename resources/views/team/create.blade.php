@extends('layouts.app')
@section('content')
{{-- 
<div class="container">
    <h2> Create Team for {{$teamLead->name}}</h2>
    <form action="{{route('team.store')}}" method="POST">
        @csrf
        <input type="hidden" name="team_lead_id" value="{{$teamLead->id}}">

        <label>Select Team Members:</label>
        <select name="team_members[]" class="form-control" multiple></select>
        @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}} - {{$user->designation}}</option>
        @endforeach
    </form>
</div> --}}

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
                        <div class="x_content">
                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{route('team.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="team_lead_id" value="{{$teamLead->id}}">
                            
                                    <label>Select Team Members:</label>
                                    <select name="team_members[]" class="form-control" multiple>
                                        @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}} - {{$user->designation}}</option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn btn-success">Create Team</button>

                                    <div>
                                        <a href="{{route('profiles')}}" class="btn btn-danger">Back</a>
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

@endsection