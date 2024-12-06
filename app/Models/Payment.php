<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 
        'amount', 
        'status', 
        'payment_date', 
        'next_payment_date', 
        'transaction_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
}
