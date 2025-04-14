@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_pannel">
                        <div class="card-header">
                            <h2>My Orders</h2>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <form action="{{route('my.orders')}}" method="get">
                                        <div class="d-flex justify-content-end">
                                            <div class="form-group ml-2">
                                                <input type="search" class="form-control form-control-sm" name="keyword" id="keyword" value="{{ request()->input('keyword') }}" placeholder="Search something...">
                                            </div>

                                            <div class="form-group ml-2">
                                                <label class="text-sm">Start Date</label>
                                                <input type="date" class="form-control form-control-sm filter" name="start_date" id="start_date" value="{{ request()->input('start_date')}}">
                                            </div>
                                            <div class="form-group ml-2">
                                                <label class="text-sm">End Date</label>
                                                <input type="date" class="form-control form-control-sm filter" name="end_date" id="end_date" value="{{ request()->input('end_date')}}">
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
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>Order Date</td>
                                            <td>Quantity</td>
                                            <td>Total Amount</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{date('d-m-Y',strtotime($order->order_date))}}</td>
                                            <td>{{$order->total_quantity}}</td>
                                            <td>{{env('CURRENCY')}}{{number_format($order->total_amount,2)}}</td>
                                            <td>
                                              <a href="{{route('view.orders',['date' => $order->order_date ])}}" class="btn btn-primary btn-info">View Details</a>
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