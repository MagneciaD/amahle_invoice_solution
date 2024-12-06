<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CompanyUpdateRequest;
use Illuminate\View\View;



class CompanyController extends Controller
{
    public function index()
    {
        // Fetch all companies
        $companies = Company::all();
        // Pass companies to the view
        return view('admin.dashboard', compact('companies'));
    }

    public function create()
    {
        return view('register_company');
    }

    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'company_name' => 'required|string|max:255',
        'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'company_details' => 'required|string',
        'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'banking_details' => 'required|string',
        'number' => 'required|string',
        'email' => 'required|email',
        'date' => 'nullable|date',
    ]);
    $company = Company::create([
        'user_id' => Auth::id(),
        'name' => $request->name,
        'address' => $request->address,
        'company_name' => $request->company_name,
        'company_logo' => null,  // Initially set to null
        'company_details' => $request->company_details,
        'signature' => null,  // Initially set to null
        'banking_details' => $request->banking_details,
        'number' => $request->number,
        'email' => $request->email,
    ]);

    if ($request->hasFile('company_logo')) {
        $logoPath = $request->file('company_logo')->store('img/logos', 'public');
        $company->company_logo = 'storage/' . $logoPath;
    }

    if ($request->hasFile('signature')) {
        $signaturePath = $request->file('signature')->store('img/signatures', 'public');
        $company->signature = 'storage/' . $signaturePath;
    }

    $company->save();

    return redirect()->route('dashboard', ['companyId' => $company->id])
        ->with('success', 'Company registered successfully.');
   }
   public function show($companyId)
    {
        $company = Company::findOrFail($companyId);
        return response()->json($company);
    }

    public function getCompanyDetails(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Fetch the company associated with the authenticated user
        $company = Company::where('user_id', Auth::id())->first();

        // Return the company details as a JSON response
        return response()->json($company);
    }
    public function edit(Request $request): View
    {
        $company = Auth::user()->company; // Assuming each user has one company
        return view('profile.edit', compact('company'));
    }

    public function update(CompanyUpdateRequest $request): RedirectResponse
    {
        $company = Auth::user()->company;

        if (!$company) {
            return Redirect::back()->withErrors(['company' => 'Company not found.']);
        }

        // Handle the company logo if a new file is uploaded
        if ($request->hasFile('company_logo')) {
            // Delete the old company logo if it exists
            if ($company->company_logo) {
                Storage::delete($company->company_logo);
            }

            // Store the new logo
            $logoPath = $request->file('company_logo')->store('img/logos', 'public');
            $company->company_logo = 'storage/' . $logoPath;
        }

        // Handle the signature if a new file is uploaded
        if ($request->hasFile('signature')) {
            // Delete the old signature if it exists
            if ($company->signature) {
                Storage::delete($company->signature);
            }

            // Store the new signature
            $signaturePath = $request->file('signature')->store('img/signatures', 'public');
            $company->signature = 'storage/' . $signaturePath;
        }

        // Update other company information
        $company->update($request->except(['company_logo', 'signature']));

        return redirect()->back()->with('success', 'Company updated successfully!');
    }
}
