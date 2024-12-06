<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 500px; width: 100%; max-height: 600px;">
        <div class="modal-content border-0" 
            style="
                border-radius: 20px; 
                overflow: hidden; 
                background: linear-gradient(145deg, #d4f4dd, #e9f7eb); 
                color: #495057; 
                box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            ">
            <div class="modal-header bg-gradient-to-r from-green-200 to-white p-4 rounded-t-lg" style="display: flex; justify-content: space-between; align-items: center;">
                <h5 class="modal-title text-xl font-bold" id="paymentModalLabel" style="margin: 0; font-size: 1.6rem;">
                    Unlock Full Access for Only R149!
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: gray;"></button>
            </div>
            <div class="modal-body" style="padding: 2rem; background: linear-gradient(145deg, #f1f8f6, #e3f1ee); border-radius: 0 0 20px 20px; box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);">
                <form action="https://sandbox.payfast.co.za/eng/process" method="POST" id="payfastForm">
                    <!-- PayFast Fields -->
                    <input type="hidden" name="merchant_id" value="10000100">
                    <input type="hidden" name="merchant_key" value="46f0cd694581a">
                    <input type="hidden" name="return_url" value="https://fa25-102-218-46-0.ngrok-free.app/payment/return">
                    <input type="hidden" name="cancel_url" value="https://fa25-102-218-46-0.ngrok-free.app/payment/cancel">
                    <input type="hidden" name="notify_url" value="https://fa25-102-218-46-0.ngrok-free.app/payment/notify">
                    <input type="hidden" name="name_first" value="{{ $company->name }}">
                    <input type="hidden" name="name_last" value="{{ $company->company_name }}">
                    <input type="hidden" name="email_address" value="{{ $company->email }}">
                    <input type="hidden" name="m_payment_id" value="{{ $company->id }}">
                    <input type="hidden" name="amount" value="100.00">
                    <input type="hidden" name="item_name" value="payment for services">
                    <input type="hidden" name="signature" value="{{ $generatedSignature }}">

                    <button type="submit" class="btn btn-primary w-100" 
                        style="
                            border-radius: 8px; 
                            background: linear-gradient(145deg, #4caf50, #2e7d32); 
                            color: #fff; 
                            font-size: 1.2rem; 
                            font-weight: bold; 
                            padding: 0.75rem; 
                            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2); 
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
                            border: none; 
                            transition: transform 0.2s ease, box-shadow 0.2s ease;">
                        Proceed with Payment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
