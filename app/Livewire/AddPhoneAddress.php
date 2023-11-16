<?php

namespace App\Livewire;


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
        session(['delivery_address' => $this->address]);
        $this->dispatch('address-added');//notify ViewAddress that things are no longer the same!

    }
    public function addPhone(){
        session(['phone' => $this->phone]);

        //extract the path of the referring url
        $path = str_replace(url('/'),'',session('refUrl'));
        //check whether the path is /login
        if($path == '/login'){
            //redirect user to home to prevent endless redirect to login
            return redirect('/');
        }

        if($path == '/cart'){
            return redirect()->route('order.checkout');
        }
        
        return redirect(session('refUrl'));
    }

}
