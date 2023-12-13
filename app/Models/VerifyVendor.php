<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyVendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id',
        'token',
    ];

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
