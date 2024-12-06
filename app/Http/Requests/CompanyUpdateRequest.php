<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ensure authorization as needed
    }

    public function rules(): array
    {
        return [
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'company_details' => 'nullable|string',
            'number' => 'nullable|string|max:15',
            'banking_details' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
