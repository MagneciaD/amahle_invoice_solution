<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom styles */
    .invoice-container {
      position: relative;
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      max-width: 900px;
      margin: auto;
    }

    .watermark {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      opacity: 0.2;
      z-index: -1;

    }

    h1 {
      font-size: 2.5rem;
      font-weight: 700;
      color: #1a1a1a;
    }

    .details-text {
      font-size: 0.9rem;
      color: #555;
    }

    .fw-bold-primary {
      color: #1a1a1a;
      font-weight: 700;
    }

    .subtotal-row {
      font-weight: bold;
    }

    .total-row {
      background-color: #f5f5f5;
      font-weight: bold;
      font-size: 1.2rem;
    }

    .thank-you {
      font-size: 2rem;
      color: #3366cc;
      font-weight: bold;
      text-align: center;
    }

    .terms p {
      font-size: 0.85rem;
      margin: 0;
    }

    /* Table Styling */
    .items-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 2rem;
    }

    .items-table th,
    .items-table td {
      border: 1px solid #ddd;
      padding: 8px;
    }

    .items-table th {
      background-color: #f8f9fa;
      text-align: left;
    }

    .items-table td {
      text-align: right;
    }

    .items-table td:first-child,
    .items-table td:nth-child(2) {
      text-align: left;
    }
  </style>
</head>
<body class="bg-light py-5">
  <div class="invoice-container position-relative shadow">
    <!-- Watermark -->
    <div class="watermark">
      <img src="{{ $company->company_logo }}" style="max-height: 800px;">
    </div>

    <!-- Header -->
    <div class="text-center mb-5">
      <h1 class="fw-bold text-primary">{{ $invoice->invoice_type }}</h1>
      <h3 style="margin-bottom: 5px;">{{ $company->name }}</h3>
      <p style="max-width: 170px; word-wrap: break-word; word-break: break-all; white-space: normal;">
        {{ $company->address }}<br>
      </p>
    </div>

    <!-- Bill To and Ship To Details -->
    <div style="margin-top: 20px;">
      <div style="width: 50%; float: left;">
        <p class="fw-bold">Bill To:</p>
        <p class="details-text">{{ $invoice->bill_to }}</p>
      </div>
      <div style="width: 60%; float: right;">
        <p class="fw-bold">Ship To:</p>
        <p class="details-text" style="max-width: 100px; word-wrap: break-word; word-break: break-all;">
          {{ $invoice->ship_to }}
        </p>
      </div>
      <div style="width: 30%; float: right;">
        <p class="fw-bold">Date</p>
        <p class="details-text">{{ $invoice->date }}</p>
        <p class="details-text">Due Date: {{ $invoice->due_date }}</p>
        <p class="details-text">Invoice Number: {{ $invoice->invoice_number }}</p>
      </div>
      <div style="clear: both;"></div>
    </div>

    <!-- Items Table -->
    <table class="items-table table table-striped">
      <thead>
        <tr>
          <th>Qty</th>
          <th>Description</th>
          <th>Unit Price</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        @php
          // Decode JSON data into arrays
          $quantities = json_decode($invoice->qty, true);
          $descriptions = json_decode($invoice->description, true);
          $unitPrices = json_decode($invoice->unit_price, true);
        @endphp

        @if(is_array($quantities) && is_array($descriptions) && is_array($unitPrices))
          @foreach($quantities as $index => $quantity)
            <tr>
              <td>{{ $quantity }}</td>
              <td>{{ $descriptions[$index] }}</td>
              <td>R {{ number_format($unitPrices[$index], 2) }}</td>
              <td>R {{ number_format($quantity * $unitPrices[$index], 2) }}</td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="4">No items available</td>
          </tr>
        @endif

        <tr class="subtotal-row">
          <td colspan="3" class="text-end">Subtotal</td>
          <td>1,995.00</td>
        </tr>
        <tr class="subtotal-row">
          <td colspan="3" class="text-end">VAT 15.0%</td>
          <td>299.25</td>
        </tr>
        <tr class="total-row">
          <td colspan="3" class="text-end">TOTAL</td>
          <td>2,294.25</td>
        </tr>
      </tbody>
    </table>

    <!-- Terms & Conditions -->
    <div class="mb-4">
      <h6 class="fw-bold-primary">Terms & Conditions</h6>
      <div class="terms">
        <p>Payment is due within 15 days</p>
        <p>Capitec Bank</p>
        <p>Sort Code: 12-34-56</p>
        <p>Account Number: 12345678</p>
      </div>
    </div>

    <!-- Thank You -->
    <div>
      <p class="thank-you">Thank you</p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
