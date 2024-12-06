<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index($companyId = null)
    {
        $user = Auth::user();

        // Redirect if user is not authenticated
        if (!$user) {
            return redirect()->route('login');
        }

        // Admin view logic
        if ($user->hasRole('admin')) {
            $companies = Company::with(['user', 'payments' => function ($query) {
                $query->latest(); // Fetch the most recent payment
            }])->get();
            $recentPayments = Payment::latest()->take(5)->get();
            return view('admin.dashboard', compact('companies', 'recentPayments'));
        }

        // Regular user view logic
        $company = $companyId ? Company::find($companyId) : $user->company;

        // Check if company exists for regular users only
        if (!$company) {
            return abort(404, 'Company not found.');
        }

        $latestPayment = Payment::where('company_id', $company->id)
            ->latest()
            ->first();

        $isPaymentCompleted = $latestPayment && $latestPayment->status === 'completed';


        // Fetch clients associated with the user's company
        $clients = Client::where('company_id', $company->id)->get();

        // Fetch latest invoices with client data
        $invoices = Invoice::with('client')
            ->where('company_id', $company->id)
            ->latest()
            ->take(6)
            ->get();

        // Update the status of overdue invoices
        foreach ($invoices as $invoice) {
            if (Carbon::now()->gt(Carbon::parse($invoice->due_date)) && $invoice->status != 'overdue') {
                $invoice->status = 'overdue';
                $invoice->save();  // Don't forget to save the change to the database
            }
        }

        // Calculate invoice counts
        $totalInvoices = Invoice::where('company_id', $company->id)->count();
        $paidInvoices = Invoice::where('company_id', $company->id)->where('status', 'paid')->count();
        $unpaidInvoices = Invoice::where('company_id', $company->id)->where('status', 'unpaid')->count();
        $overdueInvoices = Invoice::where('company_id', $company->id)->where('status', 'overdue')->count();

        // Generate the signature for the user/company
        $generatedSignature = $this->generateSignatureForDashboard($company);

        // Calculate monthly invoice count
        $monthlyInvoices = Invoice::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('company_id', $company->id) // Restrict to the company's invoices
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        // Ensure months with no invoices are represented as 0
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $monthlyInvoices[$i] ?? 0;
        }

        // Return the dashboard view with necessary data
        return view('dashboard', compact(
            'company',
            'clients',
            'invoices',
            'totalInvoices',
            'paidInvoices',
            'unpaidInvoices',
            'overdueInvoices',
            'generatedSignature',
            'monthlyData',
            'isPaymentCompleted' 
        ));
    }

    /**
     * Generate the signature for the dashboard based on the company's data
     */
    private function generateSignatureForDashboard($company)
    {
        // Example data for signature generation, adjust based on actual payment data
        $amount = 100.00;  // Example amount
        $passphrase = 'jt7NOE43FZPn';

        $data = [
            'merchant_id' => '10000100',
            'merchant_key' => '46f0cd694581a',
            'return_url' => 'https://fa25-102-218-46-0.ngrok-free.app/payment/return',
            'cancel_url' => 'https://fa25-102-218-46-0.ngrok-free.app/payment/cancel',
            'notify_url' => 'https://fa25-102-218-46-0.ngrok-free.app/payment/notify',

            'name_first' => $company->name, // Use company's actual data
            'name_last'  => $company->company_name,
            'email_address' => $company->email, // Use the correct email

            'm_payment_id' => $company->id,
            'amount' => number_format(sprintf('%.2f', $amount), 2, '.', ''),
            'item_name' => 'payment for services',
        ];

        // Generate the signature and add it to the data
        $data['signature'] = $this->generateSignature($data, $passphrase);

        return $data['signature']; // Return the signature
    }

    /**
     * Generate the signature for PayFast
     */
    private function generateSignature($data, $passPhrase = null)
    {
        // Create parameter string
        $pfOutput = '';
        foreach ($data as $key => $val) {
            if ($val !== '') {
                $pfOutput .= $key . '=' . urlencode(trim($val)) . '&';
            }
        }
        // Remove last ampersand
        $getString = substr($pfOutput, 0, -1);
        if ($passPhrase !== null) {
            $getString .= '&passphrase=' . urlencode(trim($passPhrase));
        }
        return md5($getString);
    }
}
