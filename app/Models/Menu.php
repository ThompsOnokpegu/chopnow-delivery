<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'regular_price',
        'sales_price',
        'vendor_id',
        'status',
        'product_image',
    ];

    // Define relationships here, e.g., owner (Vendor), orders, etc.
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    protected $attributes = [
        'status' => 'inactive',
    ];
}
