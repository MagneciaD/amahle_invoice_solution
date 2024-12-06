<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Payment;
use Illuminate\Http\Request;
use PDF;




class AdminController extends Controller
{
    public function managePayments()
    {
        $payments = Payment::with('company')->latest()->get();
        return view('admin.payments', compact('payments'));
    }

    public function deleteCompany($companyId)
    {
        $company = Company::findOrFail($companyId);
        $company->delete();
        return redirect()->back()->with('success', 'Comapany deleted successfully!');
    }
    public function viewPayment($id)
    {
        $payment = Payment::findOrFail($id); 
        $company = $payment->company;
        return view('admin.payment_view', compact('payment','company')); // 'admin.payment_view' should be the view you want to show the payment details in
    }
    public function downloadPaymentPDF($id)
    {
        $payment = Payment::findOrFail($id);
        $company = $payment->company;
        $pdf = PDF::loadView('admin.payment_view', compact('payment', 'company'));
        return $pdf->stream('payment_statement_' . $payment->id . '.pdf');
}
public function manageCompanies()
    {
        $companies = Company::with('user')->get();
        return view('admin.businesses', compact('companies'));
    }

}
