<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'user_id',
        'vendor_id',
        'recipient_address',
        'recipient_phone',
        'recipient_name',
        'discount',
        'payment_method',
        'payment_status',
        'order_status',
        'shipping',
        'comment',
        'total',
    ];

    // Define relationships here, e.g., customer, items (order items), etc.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
    
}


