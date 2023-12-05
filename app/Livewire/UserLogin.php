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
        $request = $this->validate(['email'=>'email|required|lowercase','password'=>'required']);
        //attempt to login user
        if(Auth::attempt(['email'=>$request['email'],'password'=>$request['password']])){
            $user = Auth::user();
            session(['delivery_address' => $user->street]);
            session(['phone' => $user->phone]);

            //extract the path of the referring url
            $path = str_replace(url('/'),'',session('refUrl'));
            
            
            if($user->street == null || $user->phone == null ){
                return redirect()->route('user.address');
            }

            //Check whether user was trying to checkout
            if($path == '/cart'){
                //redirect to checkout
                return redirect()->route('order.checkout');
            }

            //redirect user to the address
            return redirect()->route('restaurants.index');
        }
        return back()->with('error','Invalid email or password');
    }
}
