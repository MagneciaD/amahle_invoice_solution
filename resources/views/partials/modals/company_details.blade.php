<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- resources/views/partials/modals/company_details_modal.blade.php -->
<div class="modal fade" id="companyDetailsModal-{{ $company->id }}" tabindex="-1" aria-labelledby="companyDetailsModalLabel-{{ $company->id }}" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 500px; width: 80%; max-height: 500px;">
        <!-- Custom width and height -->
        <div class="modal-content border-0" style="border-radius: 15px; overflow: hidden; background: linear-gradient(to bottom right, #d4f4dd, #e9f7eb);">
            <div class="modal-header border-0 text-center" style="display: block; padding: 1.5rem;">
                <h5 class="modal-title fw-bold" id="companyDetailsModalLabel-{{ $company->id }}" style="margin: 0; font-size: 1.5rem;">
                    Company Details for <br>
                    {{ $company->company_name }}
                </h5>
                <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                @if($company->payments->isNotEmpty() && $company->payments->first()->status === 'completed')
                @php
                $payment = $company->payments->first();
                @endphp
                <div class="mb-3">
                    <p><strong>Payment Frequency:</strong> Monthly</p>
                </div>
                <div class="mb-3">
                    <p><strong>Amount Paid:</strong> ${{ number_format($payment->amount, 2) }}</p>
                </div>
                <div class="mb-3">
                    <p><strong>Last Payment Date:</strong> {{ \Carbon\Carbon::parse($payment->payment_date)->format('F j, Y') }}</p>
                </div>
                <div class="mb-3">
                    <p><strong>Next Payment Due:</strong> {{ \Carbon\Carbon::parse($payment->next_payment_date)->format('F j, Y') }}</p>
                </div>
                @else
                <div class="alert alert-danger text-center">
                    No payment details available for this company.
                </div>
                @endif

                <div class="mb-3">
                    <button type="button" class="btn" style="background-color: transparent; color: #5cb85c; border-radius: 8px; padding: 0.5rem 1rem;" onclick="sendReminderEmail('{{ $company->email }}')">
                        <i class="fas fa-envelope me-2"></i> <strong>Send Reminder Email</strong>
                    </button>
                </div>
                <div class="mb-3">
=                    <a href="{{ route('payment.download', $payment->id) }}" class="btn " style="background-color: transparent; color: #5cb85c; border-radius: 8px; padding: 0.5rem 1rem;">
                    <i class="fas fa-download me-2"></i> <strong>Download Statement (PDF)</strong>
                    </a>

                </div>
            </div>
            <div class="modal-footer border-0" style="padding: 1.5rem; display: flex; justify-content: flex-end;">
                <!-- Footer content -->
            </div>
        </div>
    </div>
</div>