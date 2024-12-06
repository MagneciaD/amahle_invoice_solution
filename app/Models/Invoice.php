<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'client_id',
        'invoice_type',
        'invoice_number',
        'bill_to',
        'ship_to',
        'date',
        'due_date',
        'qty',
        'description',
        'unit_price',
        'amount',
        'total_amount',
        'status',
        'subtotal',
        'tax',
        'signature',
        'terms_and_conditions',
    ];
    
    public function company()
{
    return $this->belongsTo(Company::class);
}
public function client()
{
    return $this->belongsTo(Client::class);
}


}
