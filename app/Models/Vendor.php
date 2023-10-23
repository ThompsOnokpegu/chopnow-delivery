<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'vendor';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'business_name',
        'kitchen_banner_image',
        'address',
        'city',
        'state',
        'kyc_type',
        'kyc_number',
        'kyc_document',
        'account_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function menus(){
        return $this->hasMany(Menu::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
