<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-container {
            width: 650px;
            /* Reduced width for smaller content */
            margin-left: 0;
            /* Align container to the far left */
            padding: 20px;
            border: 1px solid #ddd;
            font-size: 14px;
            /* Reduced font size for smaller content */
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid green;
            padding-bottom: 10px;
        }

        .invoice-header h1 {
            color: green;
            margin: 0;
            font-size: 30px;
        }

        h3 {
            font-size: 1.0em;
        }

        p {
            font-size: 0.9em;
        }

        .invoice-header .logo {
            width: 80px;
            height: 80px;
            background-color: #ddd;
            border-radius: 50%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .invoice-details div {
            width: 45%;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-table th {
            background-color: green;
            color: white;
            font-size: 14px;
            /* Reduced table font size */
        }

        .totals {
            text-align: right;
            margin-top: 20px;
            font-size: 14px;
            /* Reduced totals font size */
        }

        .totals div {
            margin-bottom: 10px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
            font-size: 18px;
            /* Reduced signature font size */
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .footer .terms {
            width: 60%;
            font-size: 13px;
            /* Reduced terms font size */
        }

        .footer .thank-you {
            width: 35%;
            text-align: right;
            font-size: 20px;
            /* Reduced thank-you font size */
            color: green;
        }
    </style>
</head>

<body>

    <div class="invoice-header">
        <div style="margin-top: 20px; padding: 0 20px;">
            <div style="margin-top: 20px;">
                <div style="width: 50%; float: left;">
                    <h2 style="margin-bottom: 3px;  color: green;">{{ $company->name }}</h2>
                    <p style="max-width: 190px; word-wrap: break-word; word-break: break-all; white-space: normal;">
                        {{ $company->address }}<br>
                </div>
                <div style="width: 30%; float: right;">
                <h2 style="margin-bottom: 3px;  color: green;">{{ $invoice->invoice_type }}</h2>
                    <img src="{{ $company->company_logo }}" style="max-height: 100px;">
                </div>
                <div style="clear: both;"></div>
            </div>
        </div>
    </div>

    <!-- Bill To and Ship To Details -->
    <div style="margin-top: 20px;">
        <div style="width: 50%; float: left;">
            <h3 style="margin-bottom: 5px;">Bill To</h3>
            <p>{{ $invoice->bill_to }}</p>
        </div>
        <div style="width: 60%; float: right;">
            <h3 style="margin-bottom: 5px;">Ship To</h3>
            <p style="max-width: 100px; word-wrap: break-word; word-break: break-all;">
                {{ $invoice->ship_to }}
            </p>
        </div>


        <div style="width: 30%; float: right;">
            <h3 style="margin-bottom: 5px;">Date: </h3>
            <p> {{ $invoice->date }}</p>
            <p> <strong>Invoice #:</strong> {{ $invoice->invoice_number }}<br></p>
            <p> <strong>Invoice Date:</strong> {{ $invoice->date }}<br></p>
            <p> <strong>PO #:</strong> 1830/2019<br></p>
            <p><strong>Due Date:</strong> {{ $invoice->due_date }} </p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <<table class="invoice-table">
    <thead>
        <tr>
            <th>QTY</th>
            <th>DESCRIPTION</th>
            <th>UNIT PRICE</th>
            <th>AMOUNT</th>
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
    </tbody>
</table>
  <div class="totals">
        <div><strong>Subtotal:</strong> {{ number_format($invoice->subtotal, 2) }}</div>
        <div><strong>VAT 15.0%:</strong> {{ number_format($invoice->tax, 2) }}</div>
        <div><strong>TOTAL:</strong> R {{ number_format($invoice->total_amount, 2) }}</div>
    </div>

    <div class="signature">
        <img src="{{ $company->signature }}" style="max-height: 100px;">
    </div>

    <div class="footer">
        <div class="terms">
            <strong>Terms & Conditions</strong><br>
            <p>{{ $invoice->terms_and_conditions }}</p>
            <h3>Banking Details:</h3>
            <p style="max-width: 190px; word-wrap: break-word; word-break: break-all;">
                {{ $company->banking_details }}
            </p>
        </div>
        <br>
        <br>
        <div class="thank-you">
            Thank you
        </div>
    </div>
    </div>

</body>

</html>