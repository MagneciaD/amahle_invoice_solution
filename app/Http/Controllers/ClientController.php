<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'client_details' => 'required|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company_id' => 'required|exists:companies,id',
        ]);

        Client::create([
            'name' => $request->name,
            'client_details' => $request->client_details,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_id' => $request->company_id,
        ]);

        return redirect()->back()->with('success', 'Client added successfully!');
    }
    public function update(Request $request)
{
    $request->validate([
        'id' => 'required|exists:clients,id',
        'name' => 'required|string|max:255',
        'client_details' => 'required|string',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
    ]);

    $client = Client::findOrFail($request->id);
    $client->update([
        'name' => $request->name,
        'client_details' => $request->client_details,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    return redirect()->back()->with('success', 'Client updated successfully!');
}
}
