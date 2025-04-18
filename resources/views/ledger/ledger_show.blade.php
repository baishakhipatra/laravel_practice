@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_pannel">
                        <div class="card-header">
                            <h3><b>Ledger - {{$user->name}}</b></h3>
                            <form action="{{route('ledger')}}" method="GET">
                                <div class="d-flex justify-content-end">
                                    <div class="form-group ml-2">
                                        <input type="search" class="form-control form-control-sm" name="keyword" id="keyword" value="{{request()->input('keyword')}}" placeholder="search something..">
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
                                            <a href="{{ url()->current()}}" class="btn btn-sm btn-light" data-toggle="tooltip" title="clear filter">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group ml-2">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                    <div> 
                                        <a href="{{route('ledger.download', request()->query() )}}"
                                        class="btn btn-danger btn-sm" target="_blank">
                                            Download PDF
                                        </a>
                                    </div>                                   
                                </div>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Transaction ID</th>
                                        <th>User</th>
                                        <th>Transaction Amount</th>
                                        <th>Purpose</th>
                                        <th>Description</th>
                                        <th>Credit</th>
                                        <th>Debit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ledgers as $ledger)
                                    <tr>
                                        <td>{{ $ledger->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $ledger->transaction_id }}</td>
                                        <td>{{$ledger->user->name ?? 'User' . $ledger->user_id }}</td>
                                        <td>{{ $ledger->transaction_amount }}</td>
                                        <td>
                                            @if($ledger->is_credit)
                                                Credit
                                            @elseif($ledger->is_debit)
                                                Debit
                                            @else
                                                -
                                            @endif
                                        </td>
                                        {{-- <td>{{ $ledger->purpose }}</td>
                                        <td>{{ $ledger->purpose_description }}</td> --}}
                                        <td>{{$ledger->purpose_description}}</td>
                                        <td>
                                            @if($ledger->is_credit)
                                                1   
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            @if($ledger->is_debit)
                                                1
                                            @else
                                                0
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-end"><strong>Total Balance:</strong></td>
                                            <td><strong class="text-success">{{number_format($totalCredit,2)}}<strong></td>
                                            <td colspan="3"><strong class="text-danger">{{number_format($totalDebit,2)}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-end"><strong>Balance</strong></td>
                                            <td colspan="4">
                                                <strong class="{{$balance >= 0 ? 'text-success' : 'text-danger'}}">
                                                    {{number_format($balance,2)}}
                                                </strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded',function(){
        var filters = document.getElementsByClassName('filter')

        Array.from(filters).forEach(function(filter){
            filter.addEventListener('change', function () {
                filter.closest('form').submit();
            });
        });
    });
</script>

@endsection