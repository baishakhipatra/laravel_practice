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
                                <h1>Recharge Wallet</h1>
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="{{ route('wallet.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="amount">Add Balance:</label>
                                                <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter amount" required>
                                                @error('amount')
                                                <div class="text-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-success mt-2">Add Balance</button>
                                            <a href="{{route('wallet.show')}}" class="btn btn-primary btn-sm">Back</a>
                                        </form>
                                    </div>
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