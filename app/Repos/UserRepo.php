<?php
namespace App\Repos;
use Illuminate\Validation\Rules\Password;

class UserRepo{

    public function rules(){
        return [
            'first_name' => 'required|min:3',
            'email' => 'required|email',
            'password' => ['required','min:8'],
        ];
    }
}