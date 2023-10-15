<?php
namespace App\Repos;

use Illuminate\Validation\Rule;

class VendorRepo{
    public function rules(){
        return [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3|nullable',
            'email' => 'required|email',
            'business_name' => 'required',
            'kitchen_banner_image' =>'required|nullable',
            'state' => ['required','nullable', Rule::in(['Cross River', 'Rivers', 'Bayelsa','Akwa Ibom'])],
            'address' => 'required|nullable',
            'city' => 'required|nullable',
            'phone' => 'required',
        ];
    }

    public function messages(){
        return [
            'kitchen_banner_image.required' =>'The display image is required',    
        ];
    }
}