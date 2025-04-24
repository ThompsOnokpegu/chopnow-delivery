<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'regular_price',
        'sales_price',
        'vendor_id',
        'status',
        'product_image',
        'product_image_pid', // Cloudinary public ID
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
