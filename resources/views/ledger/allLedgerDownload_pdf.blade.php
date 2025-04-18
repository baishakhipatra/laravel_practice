<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ledger Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 6px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .summary {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>All Ledger Entries</h2>

    <p>Date: {{ now()->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Purpose</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ledgers as $index => $ledger)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ledger->user->name ?? 'N/A' }}</td>
                    <td>{{ $ledger->transaction_id ?? '-' }}</td>
                    <td>₹{{ number_format($ledger->transaction_amount, 2) }}</td>
                    <td>{{ $ledger->is_credit ? 'Yes' : '-' }}</td>
                    <td>{{ $ledger->is_debit ? 'Yes' : '-' }}</td>
                    <td>{{ $ledger->purpose }}</td>
                    <td>{{ $ledger->purpose_description }}</td>
                    <td>{{ $ledger->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">No ledger data available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total Credit:</strong> ₹{{ number_format($totalCredit, 2) }}</p>
        <p><strong>Total Debit:</strong> ₹{{ number_format($totalDebit, 2) }}</p>
        <p><strong>Balance:</strong> ₹{{ number_format($balance, 2) }}</p>
    </div>

</body>
</html>
