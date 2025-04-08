<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  
  <!-- Bootstrap 4 CDN -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    body {
      background: #f2f2f2;
      font-family: 'Segoe UI', sans-serif;
    }

    .receipt-main {
      background: #fff;
      padding: 40px;
      margin: 50px auto;
      border-top: 5px solid #dc3545;
      box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
      max-width: 800px;
    }

    .receipt-main h5, .receipt-main h3, .receipt-main p {
      margin: 0;
    }

    .receipt-header {
      margin-bottom: 30px;
    }

    .receipt-header img {
      width: 70px;
      border-radius: 50%;
    }

    .table thead th {
      background-color: #343a40;
      color: #fff;
    }

    .input-group .form-control {
      max-width: 60px;
    }

    .btn-qty {
      min-width: 30px;
    }

    .text-total {
      font-size: 18px;
      font-weight: bold;
    }

    .print-btn {
      float: right;
    }

    @media print {
    body * {
        visibility: hidden;
    }

    #invoice, #invoice * {
        visibility: visible;
    }

    #invoice {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    .btn, .quantity-group .btn, .btn-qty, .action-col, .add-row-btn {
        display: none !important;
    }

    select, input[type="text"] {
        border: none;
        background: none;
        pointer-events: none;
    }

    table th:last-child,
    table td:last-child {
        display: none;
    }

    .product-select{
        border: none;
        background: none;
        pointer-events: none;
    }
    select {
        appearance: none !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        border: none;
        background: transparent;
        pointer-events: none; 
    }
    .invoice-total {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    margin-top: 20px;
    }

    .invoice-total p {
        font-weight: bold;
        font-size: 16px;
    }
    }

</style>
</head>
<body>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


<form method="POST" action="{{route('submit.invoice')}}" id="invoiceForm">
    @csrf
    <div id="invoice">
        <div class="container">
        <div class="receipt-main">
            
            <div class="row receipt-header">
            <div class="col-md-6">
                <img src="{{ asset($users->profile_photo_url) }}" alt="Company Logo">
            </div>
            <div class="col-md-6 text-right">
                <h5>Company Name</h5>
                <p><i class="fas fa-phone"></i> +1 3649-6589</p>
                <p><i class="fas fa-envelope"></i> company@gmail.com</p>
                <p><i class="fas fa-map-marker-alt"></i> USA</p>
            </div>
            </div>

            <div class="row mb-4">
            <div class="col-md-8">
                <h5>{{ $users->name }}</h5>
                <p><strong>Mobile:</strong> {{ $users->phone }}</p>
                <p><strong>Email:</strong> {{ $users->email }}</p>
            </div>
            <div class="col-md-4 text-right">
                <h5>INVOICE {{ \Carbon\Carbon::now()->format('dmY') }} </h5>
            </div>
            </div>

            <table class="table table-bordered" id="invoiceTable">
                <thead>
                    <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody id="invoiceBody">
                    <tr>
                    <td>
                        <select name="product_id[]" class="form-control product-select">
                        <option value="">Select Item</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->product_name }}</option>
                        @endforeach
                        </select>
                        @error('product_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary btn-qty minus" type="button">-</button>
                        </div>
                        <input type="text" class="form-control quantity text-center" name="quantity[]" value="1" min="1">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-qty plus" type="button">+</button>
                        </div>
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control amount" name="amount[]" value="0" readonly>

                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash-alt"></i></button>
                    </td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-success btn-sm" id="addRow"><i class="fas fa-plus"></i> Add Row</button>
            </div>

            <div class="invoice-total">
                <h5 class="text-right">
                    <strong>Total Amount:</strong>
                    <span id="totalAmount">0.00</span>
                    <br>
                    <strong>Total(in words):</strong>
                    <span id="amountInWords">Zero Rupees Only</span>
                </h5>
            </div>

            <div class="row mt-4">
            <div class="col-md-8">
                <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                <p class="text-muted">Thanks for shopping with us!</p>
            </div>
            <div class="col-md-4 text-right">
                <button class="btn btn-primary print-btn" onclick="printInvoice()">Print</button><br>
                <button class="btn btn-primary print-btn">Submit</button>
            </div>   
            </div>
        </div>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  function calculateAmount(row) {
    const price = parseFloat(row.find('.product-select option:selected').data('price')) || 0;
    const qty = parseInt(row.find('.quantity').val()) || 1;
    const amount = price * qty;
    row.find('.amount').val(amount.toFixed(2));
    return amount;
  }

  function updateTotal() {
    let total = 0;
    $('.product-select').each(function () {
      const row = $(this).closest('tr');
      total += calculateAmount(row);
    });
    $('#totalAmount').text(total.toFixed(2));
    $('#amountInWords').text(numberToWords(Math.floor(total)) + "Rupees Only");
  }
  

$(document).ready(function () {

    $('#addRow').click(function () {
    const newRow = $('#invoiceBody tr:first').clone();

    newRow.find('select').val('');
    newRow.find('.quantity').val(1);
    newRow.find('.amount').val(0);

    $('#invoiceBody').append(newRow);
    updateTotal();
    });

    $(document).on('click', '.remove-row', function () {
    if ($('#invoiceBody tr').length > 1) {
        $(this).closest('tr').remove();
        updateTotal();
    }
    });

    $(document).on('change keyup', '.product-select, .quantity', function () {
    const row = $(this).closest('tr');
    calculateAmount(row);
    updateTotal();
    });

    $(document).on('click', '.btn-qty', function () {
    const input = $(this).closest('.input-group').find('.quantity');
    let currentQty = parseInt(input.val()) || 1;

    if ($(this).hasClass('plus')) {
        currentQty++;
    } else if ($(this).hasClass('minus')) {
        currentQty = Math.max(1, currentQty - 1);
    }

    input.val(currentQty);
    const row = $(this).closest('tr');
    calculateAmount(row);
    updateTotal();
    });
});

function numberToWords(num) {
    const a = [
        ' ', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine',
        'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen',
        'Seventeen', 'Eighteen', 'Nineteen'
    ];
    const b = [' ', ' ', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    function convert(n) {
        if (n < 20) return a[n];
        if (n < 100) return b[Math.floor(n / 10)] + (n % 10 ? " " + a[n % 10] : "");
        if (n < 1000) return a[Math.floor(n / 100)] + " Hundred" + (n % 100 ? " and " + convert(n % 100) : "");
        if (n < 100000) return convert(Math.floor(n / 1000)) + " Thousand" + (n % 1000 ? " " + convert(n % 1000) : "");
        if (n < 10000000) return convert(Math.floor(n / 100000)) + " Lakh" + (n % 100000 ? " " + convert(n % 100000) : "");
        return convert(Math.floor(n / 10000000)) + " Crore" + (n % 10000000 ? " " + convert(n % 10000000) : "");
    }

    return num === 0 ? "Zero" : convert(num) + "Rupees Only";
}

function printInvoice() {
    const selects = document.querySelectorAll('.product-select');
    let allValid = true;

    document.querySelectorAll('.product-error').forEach(el => el.remove());
    selects.forEach((select, index) => {
        if (select.value === '') {
            allValid = false;

            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-danger product-error';
            errorDiv.textContent = 'Please select a product for this row.';
            select.parentNode.appendChild(errorDiv);
        }
    });
    if (!allValid) {
        return; 
    }
    window.print();
}
</script>
</body>
</html>
