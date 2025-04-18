@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_pannel">
                        <div class="card-header">
                            <h2>All Ledger Transactions</h2>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <form action="{{ route('all.ledger') }}" method="GET">
                                        <div class="d-flex justify-content-end">
                                            <div class="form-group ml-2">
                                                <select name="keyword" class="form-control form-control-sm filter" id="customerSelect">
                                                    <option value="">Select customer</option>
                                                    @foreach($customerNames as $id)
                                                        <option value="{{ $id }}" {{ request()->input('keyword') == $id ? 'selected' : '' }}>
                                                            {{ \App\Models\User::find($id)?->name ?? $id }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group ml-2">
                                                <label class="text-sm">Start Date</label>
                                                <input type="date" class="form-control form-control-sm filter" name="start_date" value="{{ request()->input('start_date') }}">
                                            </div>
                                            <div class="form-group ml-2">
                                                <label class="text-sm">End Date</label>
                                                <input type="date" class="form-control form-control-sm filter" name="end_date" value="{{ request()->input('end_date') }}">
                                            </div>
                                            <div class="form-group ml-2 align-self-end">
                                                <a href="{{ url()->current() }}" class="btn btn-sm btn-light" data-toggle="tooltip" title="Clear Filter">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{route('all.ledger.download', request()->query())}}" 
                                                    class="btn btn-primary btn-sm" target="_blank">
                                                        Download PDF
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="x_content">
                                <table class="table table-bordered table-striped table-hover text-center shadow-sm">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Date</th>
                                            <th>Transaction ID</th>
                                            <th>User</th>
                                            <th>Transaction Amount</th>
                                            <th>Type</th>
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
                                                <td>{{ $ledger->user->name ?? 'User ' . $ledger->user_id }}</td>
                                                <td>{{ number_format($ledger->transaction_amount, 2) }}</td>
                                                <td>
                                                    @if($ledger->is_credit) Credit
                                                    @elseif($ledger->is_debit) Debit
                                                    @else - @endif
                                                </td>
                                                <td>{{ $ledger->purpose_description }}</td>
                                                <td>{{ $ledger->is_credit ? number_format($ledger->transaction_amount, 2) : '-' }}</td>
                                                <td>{{ $ledger->is_debit ? number_format($ledger->transaction_amount, 2) : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-end"><strong>Total</strong></td>
                                            <td class="text-success"><strong>{{ number_format($totalCredit, 2) }}</strong></td>
                                            <td class="text-danger"><strong>{{ number_format($totalDebit, 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-end"><strong>Balance</strong></td>
                                            <td colspan="2">
                                                <strong class="{{ $balance >= 0 ? 'text-success' : 'text-danger' }}">
                                                    {{ number_format($balance, 2) }}
                                                </strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="pagination-container d-flex justify-content-end mt-3">
                                    {{ $ledgers->appends(request()->query())->links() }}
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
        var filters = document.querySelectorAll('.filter');
        filters.forEach(function (el) {
            el.addEventListener('change', function () {
                el.closest('form').submit();
            });
        });
    });
</script>

@endsection