<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Company;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function handlePaymentNotify(Request $request)
{
    
    Log::debug('Payment notification received', ['request' => $request->all()]);

    // Validate incoming request
    $validatedData = $request->validate([
        'm_payment_id' => 'required|string', 
        'amount_gross' => 'required|numeric',  // Update to handle gross amount
        'payment_status' => 'required|string',
        'signature' => 'required|string', 
        'pf_payment_id' => 'required|string', 

    ]);

    // Verify the signature
    $passphrase = 'jt7NOE43FZPn'; // Replace with your secure passphrase
    $generatedSignature = $this->generateSignature($request->except('signature'), $passphrase);

    if ($generatedSignature !== $validatedData['signature']) {
        // Log the error if the signature is invalid
        Log::error('Invalid signature received for payment notification.', [
            'received_signature' => $validatedData['signature'],
            'expected_signature' => $generatedSignature,
            'request_data' => $request->all(),
        ]);
        
        return response()->json(['error' => 'Invalid signature'], 400);
    }

    // Process the payment data if the signature is valid
    try {
        $company = Company::findOrFail($request->m_payment_id); // Fetch company by payment ID

        // Create a new payment record
        $payment = new Payment();
        $payment->company_id = $company->id;
        $payment->amount = $validatedData['amount_gross'];
        $payment->status = $validatedData['payment_status'] === 'COMPLETE' ? 'completed' : 'failed';
        $payment->payment_date = now();
        $payment->transaction_id = $validatedData['m_payment_id'];
        $payment->next_payment_date = $this->calculateNextPayment('monthly'); // You can modify this based on payment type
        $payment->save();

        // Log the successful payment record creation
        Log::info('Payment successfully recorded in the database.', $payment->toArray());
        session()->flash('new_payment', $payment);


    } catch (\Exception $e) {
        // Log the exception if there's an error
        Log::error('Error processing payment notification.', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Failed to process payment'], 500);
    }

    return redirect()->route('admin.dashboard');  // Make sure you have this route set up for the dashboard

}


    public function handlePaymentReturn(Request $request)
    {
        return view('payment.success');
    }

    public function handlePaymentCancel()
    {
        return view('payment.cancel');
    }

    private function generateSignature($data, $passPhrase = null) {
        // Create parameter string
        $pfOutput = '';
        foreach( $data as $key => $val ) {
            if($val !== '') {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        $getString = substr( $pfOutput, 0, -1 );
        if( $passPhrase !== null ) {
            $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
        }
        return md5( $getString );
    } 

    private function calculateNextPayment(string $paymentType): \Carbon\Carbon
    {
        return $paymentType === 'monthly' ? now()->addMonth() : now()->addMonths(6);
    }

    public function showDashboard()
{
    $recentPayments = Payment::latest()->take(8)->get(); // Get the 8 most recent payments
    $companies = Company::all(); // Fetch all companies, or modify to your needs
    return view('admin.dashboard', compact('recentPayments', 'companies'));
}

}
