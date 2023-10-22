<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_code',
        'bank_name',
        'account_name',
        'account_number',
        'recipient_code',
        'vendor_id', 
        'status',
    ];

    // Define relationships here, e.g., owner (Vendor), etc.
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
