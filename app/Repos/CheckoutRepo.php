<?php
namespace App\Repos;
use Illuminate\Validation\Rules\Password;

class CheckoutRepo{

    public static function rules(){
        return [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:11',
            'address' => 'required',
            'address2' => 'nullable',
            'payment_method' => 'required'
        ];
    }
}