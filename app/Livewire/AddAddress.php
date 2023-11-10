<?php

namespace App\Livewire;

use Livewire\Component;

class AddAddress extends Component
{
    public $address;
    public function render()
    {
        return view('livewire.add-address');
    }

    public function add(){
        session(['delivery_address' => $this->address]);
        $this->dispatch('address-added');//notify ViewAddress that things are no longer the same!
        session()->flash('message', $this->address.' added.');
    }

}
