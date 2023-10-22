<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id',
        'reference',
        'transfer_code',
        'type',
        'amount',
        'status',
    ];

    // Define the relationship with the Wallet model
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
