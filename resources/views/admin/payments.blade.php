<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="min-vh-100 bg-light py-5">
    <div class="container px-4">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1 class="display-4 text-success">
                💳 Payment Records
            </h1>
            <p class="text-muted">Manage and review all payment history</p>
        </div>

        <!-- Card Container -->
        <div class="bg-white rounded-4 shadow-lg p-5">
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-success text-white">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Company Name</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                            <th>Next Payment</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">View Statement</th> <!-- New Column -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td class="text-center text-secondary font-weight-bold">{{ $payment->id }}</td>
                            <td>{{ $payment->company->company_name ?? 'Unknown' }}</td>
                            <td class="text-success font-weight-bold">${{ number_format($payment->amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('j F Y') }}</td>
                            <td>{{ $payment->next_payment_date ? \Carbon\Carbon::parse($payment->next_payment_date)->format('j F Y') : 'N/A' }}</td>
                            <td class="text-center">
                                <span class="badge 
                                    {{ $payment->status === 'Paid' ? 'bg-success' : 
                                       ($payment->status === 'Overdue' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('payment.view', $payment->id) }}" class="btn btn-info btn-sm">
                                    View Statement
                                </a>
                            </td> <!-- View Statement Button -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
