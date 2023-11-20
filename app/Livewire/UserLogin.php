<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserLogin extends Component
{
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.user-login');
    }
 
    public function login(){
        $user = $this->validate(['email'=>'email|required|lowercase','password'=>'required']);
        //attempt to login user
        if(Auth::attempt(['email'=>$user['email'],'password'=>$user['password']])){
            //extract the path of the referring url
            $path = str_replace(url('/'),'',url()->previous());
            //dd($path);
            //Check whether user was trying to visit profile
            if($path == '/profile'){
                //redirect to checkout
                return redirect()->route('user.profile');
            }
            //redirect user to the address
            return redirect()->route('user.address');
        }
        return back()->with('message','Invalid email or password');
    }
}
