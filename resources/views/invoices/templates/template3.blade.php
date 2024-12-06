<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: green; /* Background color for header */
            padding: 10px;
            color: white;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0; /* Removes any margin */
        }
        h2 {  
            font-size: 1.2em; /* Adjusted size for headers */
           
        }
        .invoice-title {
            font-size: 24px;
            text-align: right;
            margin: 0; /* Removes any margin */
        }
        .company-info p {
            margin: 5px 0;
        }
        .details, .bill-to, .ship-to, .due-date {
            margin-bottom: 20px;
        }
        .bill-to, .ship-to, .due-date{
            display: inline-block;
            width: 30%;
            vertical-align: top;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .total {
            font-weight: bold;
        }
        .totals {
            text-align: right;
            margin-top: 20px;
            font-size: 14px;
            /* Reduced totals font size */
        }
        .terms {
            margin-top: 30px;
        }
        .signature {
            text-align: right;
            margin-top: 20px;
        }
        .info-container {
            background-color: #89C703; /* Background color for the info container */
            padding: 10px; /* Padding inside the container */
            margin-top: 20px; /* Adds margin above the container */
        }
        .info-container h2 {
            margin: 0; /* Removes margin to maintain layout */
            color: white; /* Text color for visibility */
        }
        .logo-address-container {
            display: flex; /* Use flexbox for layout */
            justify-content: space-between; /* Space between logo and address */
            align-items: center; /* Center items vertically */
            margin-top: 10px; /* Adds space above the logo and address */
        }
        .logo-container {
            text-align: right; /* Aligns logo to the right */
            margin-left: auto; /* Pushes logo to the right */
        }
        .address {
            text-align: left; /* Align address to the left */
            margin: 0; /* Remove margin */
        }
    </style>
</head>
<body>

<div class="info-container">
        <div style="width: 50%; float: left;">
            <h2>{{ $company->name }}</h2>          
        </div>
        <div style="width: 20%; float: right;">
            <h2>{{ $invoice->invoice_type }}</h2>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div style="width: 50%; float: left;">
    <p style="max-width: 190px; word-wrap: break-word; word-break: break-all; white-space: normal;">
    {{ $company->address }}<br> 
        </div>
        <div style="width: 20%; float: right;">
        <img src="{{ $company->company_logo }}" style="max-height: 100px;"> <!-- Logo aligned to the right -->
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="bill-to">
        <p><strong>Bill To:</strong></p>
        <p>{{ $invoice->bill_to }}</p>
    </div>

    <div class="ship-to">
        <p><strong>Ship To:</strong></p>
        <p style="max-width: 120px; word-wrap: break-word; word-break: break-all;">
                {{ $invoice->ship_to }}
            </p>
    </div>
    <div class="due-date">
    <p><strong>Due Date:</strong></p>
     <p>{{ $invoice->due_date }} </p>
     <p>Invoice #: </strong> {{ $invoice->invoice_number }}</p>
     <p>Invoice Date: </strong> {{ $invoice->date }}</p>
      <p>P.O.#: </strong> 1834/2019</p>
    </div>
    <table>
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
        <div><strong>VAT 15.0%:</strong> {{ number_format($invoice->total_amount, 2) }}</div>
        <div><strong>TOTAL:</strong> R {{ number_format($invoice->total_amount, 2) }}</div>
    </div>

    <div class="signature">
    <img src="{{ $company->signature }}" style="max-height: 50px;"> <!-- Logo aligned to the right -->
    <p>Authorized Signature</p>
    </div>

    <div class="terms">
        <p><strong>Terms & Conditions</strong></p>
        <p>{{ $invoice->terms_and_conditions }}</p>
        <p style="max-width: 190px; word-wrap: break-word; word-break: break-all;">
         {{ $company->banking_details }}</p>
        </div>
</div>
</body>
</html>
