<?php
namespace App\Repos;
use Illuminate\Validation\Rules\Password;

class CheckoutRepo{

    public static function rules(){
        return [
            'alternate_name' => 'required|min:3',
            'alternate_phone' => 'required|min:11',
            'alternate_address' => 'required',
            'address2' => 'nullable',
        ];
    }
}