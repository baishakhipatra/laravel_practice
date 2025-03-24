@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_pannel">
                        <div class="card-header">
                            <h2>All User Queries</h2>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <form action="" method="get">
                                        <div class="d-flex justify-content-end">
                                            <div class="form-group ml-2">
                                                <input type="search" class="form-control form-control-sm" name="keyword" id="keyword" value="{{ request()->input('keyword') }}" placeholder="Search something...">
                                            </div>
                        
                                            <div class="form-group ml-2">
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-filter"></i>
                                                    </button>
                                                    <a href="{{ url()->current() }}" class="btn btn-sm btn-light" data-toggle="tooltip" title="Clear filter">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="x_content">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @dd($chat); --}}
                                        @foreach ($users as $key=> $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{optional($item->user)->name}}</td>
                                            <td>{{optional($item->user)->email}}</td>
                                            <td>
                                                <a href="{{ route('admin_chat', $item->user_id) }}" class="btn btn-success">Chat</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection