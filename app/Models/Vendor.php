<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\CanResetPassword;
class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'vendor';
    protected $fillable = [
        'first_name',
        'last_name',
        //'email', DO NOT MASS ASSIGN
        'password',
        'phone',
        'business_phone',
        'business_name',
        'slug',
        'kitchen_banner_image',
        'kitchen_banner_pid',  //kitchen banner image public id
        'address',
        'city',
        'state',
        'kyc_type',
        'kyc_number',
        'kyc_document',
        'kyc_document_pid',
        'account_status',
        'delivery_fee',
        'preparation_time',
        'restaurant_type_id',
        'business_type',
        'verified',
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


}
