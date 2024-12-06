<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<style>
    .invoice-card {
        max-width: 800px;
        margin: 0 auto;
    }

    .card-header {
        background: linear-gradient(to right, #d1fae5, #ffffff);
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-weight: bold;
    }

    .status-paid {
        background-color: #d1f7e2;
        color: #388e3c;
    }

    .status-overdue {
        background-color: #f8d7da;
        color: #721c24;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
</style>

<div class="content content-full">
    <!-- Invoice Card -->
    <div class="bg-white shadow-lg rounded-lg invoice-card mx-auto mt-6">
        <div class="card-header p-4 rounded-t-lg">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold">
                    <div class="invStatus redStatus">
                        <span class="invNum">Payment Statement #{{ $payment->id }}&nbsp;&nbsp;</span>
                    </div>
                </h3>
                <div class="block-options">
                    <a href="{{ route('payment.download', $payment->id) }}" class="btn btn-info btn-sm">
                        Download Statement (PDF)
                    </a>
                </div>
            </div>
        </div>

        <div id="viewInvoiceMainBlock" class="p-6">
            <!-- Payment Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Company Info -->
                <div>
                    <img id="selected_logo" src="{{ asset($company->company_logo) }}" class="w-full max-h-32 object-contain mb-2">
                    <p class="text-lg font-bold">{{ $company->name }}</p>
                    <p class="text-gray-600" style="max-width: 250px; word-wrap: break-word; word-break: break-all;">
                        {{ $company->address }}
                    </p>
                </div>

            </div>
            <div class="mb-4">
                <p><strong>Amount:</strong> ${{ number_format($payment->amount, 2) }}</p>
                <p><strong>Payment Date:</strong> {{ \Carbon\Carbon::parse($payment->payment_date)->format('j F Y') }}</p>
                <p><strong>Next Payment Date:</strong> {{ $payment->next_payment_date ? \Carbon\Carbon::parse($payment->next_payment_date)->format('j F Y') : 'N/A' }}</p>
            </div>

            <!-- Status -->
            <div>
                <span class="status-badge 
                    @if($payment->status === 'Paid') status-paid 
                    @elseif($payment->status === 'Overdue') status-overdue
                    @else status-pending 
                    @endif">
                    {{ ucfirst($payment->status) }}
                </span>
            </div>

            <!-- Total Due -->
            <div class="mt-6 bg-green-100 text-green-800 text-center p-4 rounded-lg">
                Total : <strong>${{ number_format($payment->amount, 2) }}</strong>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.payments') }}" class="btn btn-secondary mt-4">Back to Payments</a>
            </div>
        </div>
    </div>
    <!-- END Payment Card -->
</div>