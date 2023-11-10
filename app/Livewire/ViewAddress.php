<?php

namespace App\Livewire;

use Livewire\Component;

class ViewAddress extends Component
{
    protected $listeners = ['address-added' => 'render'];//I want you to eavesdrop on AddAddress

    public function render()
    {
        return view('livewire.view-address');
    }
}
