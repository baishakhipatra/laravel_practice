@extends('layouts.app')
@section('content')
<style>
    .message {
        margin: 5px 0;
        padding: 8px;
        border-radius: 5px;
        background-color: #f1f1f1;
    }

    .text-right {
        text-align: right;
        background-color: #1c4877;
        color: white;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="x-content">
                @if (session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">Chat With {{$user->name}}</div>
                    <div class="card-body">
                        <div id="chat-box">
                            {{-- @foreach($chats as $chat)
                            <div class="message {{ $chat->sender == 'admin' ? 'text-right' : '' }}">
                            <strong>{{ ucfirst($user->name) }}:</strong> {{ $chat->message }}
                            <em>{{ $chat->created_at->format('d M Y, h:i A') }}</em>
                            </div>
                            @endforeach --}}

                            @foreach($chats as $chat)
                            <div class="message {{ $chat->sender == 'admin' ? 'text-right bg-primary text-white p-2 rounded' : 'text-left bg-light p-2 rounded' }} mb-2">
                                <strong>{{ $chat->sender == 'admin' ? 'Admin' : ucfirst($user->name) }}:</strong> 
                                {{ $chat->message }}
                                <em class="d-block" style="font-size: 0.8rem;">{{ \Carbon\Carbon::parse($chat->created_at)->format('d M Y, h:i A') }}</em>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card-footer">
                        <form action="{{route('send_message')}}"  method="POST">
                            @csrf
                            <div class="input-group">
                                {{-- <input type="hidden" name="user_id" value="{{$chats->first()->user_id}}"> --}}
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <div class="input-group">
                                    <input type="text" name="message" class="form-control" placeholder="Type your message here...">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                    <a href="{{route('show_query')}}" class="btn btn-danger">Back</a> 
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>


@endsection