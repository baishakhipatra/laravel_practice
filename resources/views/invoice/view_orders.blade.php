@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_pannel">
                        <div class="card-header">
                            <h2>View Orders</h2>
                            <div class="text-right">
                                <a href="{{route('my.orders')}}" class="btn btn-primary btn-sm">
                                    <i class="ri-arrow-left-wide-line"></i>
                                    Back</a>
                             </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    {{-- <form action="{{route('order.history')}}" method="get">
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
                                    </form> --}}
                                </div>
                            </div>
                            <div class="x_content">
                                @forelse ($orders as $invoice)
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <strong>Order Date:</strong>{{$invoice->created_at->format('d M Y H:i')}} |
                                        <strong>Total:</strong>{{number_format($invoice->total_amount,2)}}
                                    </div>
                                    <div class="card body p-0">
                                        <table class="table table-sm mb-0">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tboby>
                                                @foreach ($invoice->items as $item)
                                                <tr class="text-center">
                                                    <td>{{$item->product->product_name ?? 'N/A'}}</td>
                                                    <td>{{$item->quantity}}</td>
                                                    <td>{{number_format($item->product->price ?? 0, 2)}}</td>
                                                    <td>{{number_format($item->product->price * $item->quantity, 2)}}</td>
                                                </tr>
                                                @endforeach
                                            </tboby>
                                        </table>
                                    </div>
                                </div>
                                @empty
                                <div class="alert alert-info"> You haven't placed any order yet</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection