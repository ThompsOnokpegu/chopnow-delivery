<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateContact extends Component
{
    public $street;
    public $city;
    public $phone;
    

    public function render()
    {
        return view('livewire.user.update-contact');
    }

    public function updateContact(){
        
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();

        $user->street = $this->street;
        $user->city = $this->city;
        $user->phone = $this->phone;

        $user->save();

        session()->flash('default-contact','Contact updated!');
    }

    public function mount(){
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();

        $this->street = $user->street;
        $this->city = $user->city;
        $this->phone = $user->phone;
    }
}
