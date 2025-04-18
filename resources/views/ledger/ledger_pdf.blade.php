<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Ledger - {{ $user->name }}</h2>
    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Transaction ID</th>
                <th>Amount</th>
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
                <td>{{ $ledger->purpose_description }}</td>
                <td>{{ $ledger->is_credit ? '1' : '0' }}</td>
                <td>{{ $ledger->is_debit ? '1' : '0' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-end"><strong>Balance</strong></td>
                <td colspan="4">
                    <strong class="{{$balance >= 0 ? 'text-success' : 'text-danger'}}">
                        {{number_format($balance,2)}}
                    </strong>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>



