@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_pannel">
                        <div class="card-header">
                            <h2>Sales Generate</h2>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <form action="{{route('all.invoices')}}" method="GET">
                                        <div class="d-flex justify-content-end">
                                            <div class="form-group ml-2">
                                                {{-- <input type="search" class="form-control form-control-sm" name="keyword" id="keyword" value="{{request()->input('keyword')}}" placeholder="search something.."> --}}
                                                <select name="keyword" class="form-control form-control-sm filter" id="customerSelect">
                                                    <option value="">Select customer</option>
                                                    @foreach($customerNames as $name)
                                                    <option value="{{ $name }}" {{ request()->input('keyword') == $name ? 'selected' : ''}}>
                                                        {{ $name }}
                                                    </option>
                                                    @endforeach
                                                </select>
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
                                                    {{-- <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-filter"></i>
                                                    </button> --}}
                                                    <a href="{{ url()->current()}}" class="btn btn-sm btn-light" data-toggle="tooltip" title="clear filter">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="x_content">
                                <table class="table table-bordered table-striped table-hover text-center shadow-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="width: 50px">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Total Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $index => $item)
                                        <tr>
                                            <td>{{ $data->firstItem() + $index }}</td>
                                            <td class="text-capitalize">{{ $item->customer_name }}</td>
                                            <td>{{ $item->customer_email }}</td>
                                            <td class="font-weight-bold text-success">{{ number_format($item->total_amount, 2) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y h:i A') }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No Records Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right font-weight-bold">Total:</td>
                                            <td colspan="2" class="font-weight-bold text-success">
                                                {{number_format($totalAmount,2)}}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="pagination-container d-flex justify-content-end mt-3">
                                    {{ $data->appends($_GET)->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var selects = document.getElementsByClassName('filter');

        Array.from(selects).forEach(function(select) {
            select.addEventListener('change', function () {
                var form = select.closest('form');
                if (form) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection