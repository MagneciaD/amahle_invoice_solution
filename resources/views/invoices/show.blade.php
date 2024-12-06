<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    /* Custom CSS for modern card style */
    .invoice-card {
        max-width: 800px;
        /* Set a maximum width for the card */
    }

    .card-header {
        background: linear-gradient(to right, #d1fae5, #ffffff);
    }

    .table th,
    .table td {
        vertical-align: middle;
    }
</style>

<div class="content content-full">
    <!-- Invoice Card -->
    <div class="bg-white shadow-lg rounded-lg invoice-card mx-auto mt-6">
        <div class="card-header p-4 rounded-t-lg">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold">
                    <div class="invStatus redStatus">
                        <span class="invNum">#{{ $invoice->invoice_number }}&nbsp;&nbsp;<span class="text-red-600">{{ $invoice->status }}</span></span>
                    </div>
                </h3>
                <div class="block-options">
                    <a href="{{ route('invoices.chooseTemplate', $invoice->id) }}" class="text-gray-600 hover:text-gray-800">
                        <i class="fas fa-download"></i> Download
                    </a>
                </div>
            </div>
        </div>

        <div id="viewInvoiceMainBlock" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <img id="selected_logo" src="{{ asset($company->company_logo) }}" class="w-full max-h-32 object-contain mb-2">
                    <p class="text-lg font-bold">{{ $company->name }}</p>
                    <p class="text-gray-600" style="max-width: 250px; word-wrap: break-word; word-break: break-all;">
                        {{ $company->address }}
                    </p>
                </div>
                <div class="flex flex-col items-start ml-20">
                    <p class="text-lg font-bold">Client</p>
                    <div class="mt-2">
                        <span class="text-gray-800"><strong>{{ $invoice->bill_to }}</strong></span>
                    </div>
                    <div class="mt-2">
                        <p class="text-gray-600" style="max-width: 200px; word-wrap: break-word; word-break: break-word;">
                            {{ $invoice->ship_to }}
                        </p>
                    </div>

                    <!-- Invoice Type -->
                    <div class="mt-4">
                        <input type="text"
                            id="invoice_type_display"
                            name="invoice_type_display"
                            class="form-control border-none focus:outline-none placeholder-gray-500 bg-gray-100 text-gray-800 p-2 rounded-lg"
                            placeholder="{{ $invoice->invoice_type }}"
                            required
                            readonly>
                    </div>
                </div>
                <!-- END Client Info -->
            </div>

            <h4 class="text-lg font-semibold mb-4">Items</h4>
            <!-- Items Table -->
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Qty</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Unit Price</th>
                        <th class="border px-4 py-2">Amount</th>
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
                        <td class="border px-4 py-2">{{ $quantity }}</td>
                        <td class="border px-4 py-2">{{ $descriptions[$index] }}</td>
                        <td class="border px-4 py-2">R {{ number_format($unitPrices[$index], 2) }}</td>
                        <td class="border px-4 py-2">R {{ number_format($quantity * $unitPrices[$index], 2) }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="4" class="border px-4 py-2 text-center">No items available</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <!-- END Table -->

            <div id="paymentBlock" class="mt-6">
                <div class="sub-heading">
                    <form action="{{ route('invoices.updateType', $invoice->id) }}" method="POST" class="mt-3" id="invoiceTypeForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="updated_invoice_type" name="invoice_type">
                        <button type="button" id="dropdownButton" class="bg-transparent text-red-600 font-bold border-none hover:underline focus:outline-none text-lg">
                            Update Invoice Type
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdown" class="hidden mt-2 bg-white border border-gray-300 rounded-md shadow-lg">
                            <ul class="max-h-60 overflow-auto">
                                @foreach(['Invoice', 'Tax Invoice', 'Proforma Invoice', 'Receipt', 'Sales Receipt', 'Cash Receipt', 'Delivery Note', 'Purchase Order', 'Credit Note', 'Credit Memo', 'Estimate', 'Quote'] as $type)
                                <li class="cursor-pointer hover:bg-gray-200 p-2" onclick="updateInvoiceType('{{ $type }}')">
                                    {{ $type }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="bg-green-100 text-green-800 text-center p-4 mt-2 rounded-lg">
                    Total Due: {{ \Carbon\Carbon::parse($invoice->due_date)->format('dS M, Y') }} <strong>R {{ number_format($invoice->total_amount, 2) }} </strong>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdown = document.getElementById('dropdown');
    const invoiceTypeInput = document.getElementById('updated_invoice_type');
    const invoiceTypeDisplay = document.getElementById('invoice_type_display');
    const invoiceTypeForm = document.getElementById('invoiceTypeForm');

    dropdownButton.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });

    function updateInvoiceType(type) {
        invoiceTypeInput.value = type;
        invoiceTypeDisplay.placeholder = type;
        dropdown.classList.add('hidden');
        invoiceTypeForm.submit();
    }

    document.addEventListener('click', (event) => {
        if (!dropdownButton.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>