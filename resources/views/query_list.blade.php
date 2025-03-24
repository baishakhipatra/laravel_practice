@extends('layouts.app')
@section('content')


<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_pannel">
                        <div class="card-header">
                            <h2>My Queries</h2>
                            <div class="clearfix"></div>
                            <div class="x_content">
                                <div id="chat-box">
                                    @foreach ($queries as $query)
                                        <div class="message text-{{$query->sender=="user"?"left":"right"}} bg-light p-2 rounded mb-2">
                                            <strong>{{$query->user->name}}:</strong>
                                            {{$query->message}}
                                            <em class="d-block" style="font-size: 0.8rem;">21 Mar 2025, 11:37 AM</em>
                                        </div>
                                    @endforeach 
                                </div>                 
                            </div>
                        </div>
                        <div class="card-footer">
                            <form action="{{route('user_send_message')}}" method="POST">
                                @csrf
                                    <input type="hidden" name="user_id" value="9">
                                    <div class="input-group">
                                        <input type="text" name="message" class="form-control" placeholder="Type your message here...">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection