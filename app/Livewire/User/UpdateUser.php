<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateUser extends Component
{
    public $first_name;
    public $last_name;
    public $email;

    public function render()
    {
        return view('livewire.user.update-user');
    }

    public function updateUser(){

        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();

        $user->name = $this->first_name;
        $user->last_name = $this->last_name;

        $user->save();

        session()->flash('basic-info','Account updated!');
        
    }

    public function mount(){
        $user_id = Auth::user()->id;
        $user = User::where('id',$user_id)->first();

        $this->first_name = $user->name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;

    }
}
