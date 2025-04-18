@extends('layouts.app')
@section('content')

<div class="card">
    <div class="right_col" role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_pannel">
                        <div class="card-header">
                            <div class="container">
                                <h1>Wallet Overview</h1>
                                <div class="card">
                                    <div class="card-header">
                                        Wallet Balance
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Your current balance is:</h5>
                                        <h2><p><strong>Wallet Balance:</strong> {{env('CURRENCY')}}{{ number_format($totalBalance, 2)}}</p></h2>
                                        <a href="{{ route('wallet.create') }}" class="btn btn-secondary">Add More</a>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <h3>Recharge History</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Last Recharge Amount</th>
                                                <th>Recharged on</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $sl = 0;
                                            @endphp
                                            @forelse($wallets as $index=>$item)
                                            @php
                                            $sl++;
                                            @endphp
                                            <tr>
                                                <td>{{$sl}}</td>
                                                <td>{{env('CURRENCY')}}{{number_format($item->amount_added, 2)}}</td>
                                                <td>{{$item->created_at->format('d M Y')}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3">
                                                    <h3><p>No Recharge History Yet</p></h3>
                                                </td>
                                            </tr>
                                            @endforelse
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
</div>
@endsection