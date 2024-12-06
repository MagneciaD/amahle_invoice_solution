<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route for the email verification prompt
Route::get('/email/verify', EmailVerificationPromptController::class)
    ->middleware('auth') // Ensure the user is authenticated
    ->name('verification.notice');

// Route to resend the verification email
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('auth')
    ->name('verification.send');

// Route for the dashboard (requires email verification)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('verified') // Only verified users can access
    ->name('dashboard');
// Admin-specific routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/payments', [AdminController::class, 'managePayments'])->name('admin.payments');
    Route::get('/admin/businesses', [AdminController::class, 'manageCompanies'])->name('admin.businesses');
    Route::delete('/admin/companies/{companyId}', [AdminController::class, 'deleteCompany'])->name('admin.companies.delete');
});
Route::get('/payments/{id}/view', [AdminController::class, 'viewPayment'])->name('payment.view');
Route::get('/payment/{id}/download', [AdminController::class, 'downloadPaymentPDF'])->name('payment.download');


//profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 // Company Routes
 // Routes for company profile
 Route::get('/company/edit', [CompanyController::class, 'edit'])->name('company.edit');
 Route::patch('/company/update', [CompanyController::class, 'update'])->name('company.update');

    
});

//company routes
Route::middleware(['auth'])->group(function () {
    Route::get('/register-company', [CompanyController::class, 'create'])->name('register.company');
    Route::post('/register-company', [CompanyController::class, 'store'])->name('company.store');
});


//invoices routes
Route::get('/invoices', [InvoiceController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('invoices');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('/invoices/choose-template/{invoiceId}', [InvoiceController::class, 'chooseTemplate'])->name('invoices.chooseTemplate');
Route::post('/invoices/generate-pdf/{invoiceId}', [InvoiceController::class, 'generatePDF'])->name('invoices.generatePDF');
Route::post('/invoices/{id}/update-status', [InvoiceController::class, 'updateStatus'])->name('invoices.updateStatus');
Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

Route::post('/invoices/update-status', [InvoiceController::class, 'updateStatus'])->name('invoices.updateStatus');
Route::get('/invoices/{invoiceId}/preview', [InvoiceController::class, 'preview'])->name('invoices.preview');
Route::put('/invoices/{id}/update-type', [InvoiceController::class, 'updateInvoiceType'])->name('invoices.updateType');
Route::post('/client/update', [ClientController::class, 'update'])->name('client.update');



Route::get('/search', [InvoiceController::class, 'search'])->name('search');

Route::get('/invoices/{id}', [InvoiceController::class, 'shows'])->name('invoices.show');


//payfast 

Route::post('/payment/notify', [PaymentController::class, 'handlePaymentNotify'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class, \Illuminate\Auth\Middleware\Authenticate::class])
    ->name('payment.notify');
Route::get('/payment/return', [PaymentController::class, 'handlePaymentReturn'])->name('payment.return');
Route::get('/payment/cancel', [PaymentController::class, 'handlePaymentCancel'])->name('payment.cancel');
Route::get('/payment/success', [PaymentController::class, 'showPaymentSuccess'])->name('payment.success'); // Success page
Route::get('/payment/failed', [PaymentController::class, 'showPaymentFailed'])->name('payment.failed'); // Failed page
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');


require __DIR__.'/auth.php';
