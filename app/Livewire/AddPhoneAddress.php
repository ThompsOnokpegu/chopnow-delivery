<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddPhoneAddress extends Component
{
    public $phone;
    public $address;

    public function render()
    {
        return view('livewire.add-phone-address');
    }

    public function addAddress(){
        $user = Auth::user();

        if($user->street == null){
            session(['delivery_address' => $this->address]);
            $user = User::where('id',$user->id)->first();
            $user->street = $this->address;
            $user->save();
        }
        
        $this->dispatch('address-added');//notify ViewAddress that things are no longer the same!

    }
    public function addPhone(){
        $user = Auth::user();
        if($user->phone == null ){
            session(['phone' => $this->phone]);
            $user = User::where('id',$user->id)->first();
            $user->phone = $this->phone;
            $user->save();
        }
        
        //extract the path of the referring url
        $path = str_replace(url('/'),'',session('refUrl'));
        
        //Check whether user was trying to checkout
        if($path == '/cart'){
            //redirect to checkout
            return redirect()->route('order.checkout');
        }
        
        return redirect()->route('restaurants.index');
    }

}
