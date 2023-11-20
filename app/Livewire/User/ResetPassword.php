<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPassword extends Component
{
    public $current_password;
    public $new_password;

    public function render()
    {
        return view('livewire.user.reset-password');
    }

    public function resetPassword(){
        $user = Auth::user();
        # Validation
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required',
        ]);
  
        #Match The Old Password
        if(!Hash::check($this->current_password, $user->password)){
            session()->flash("error", "Old password doesn't match!");
        }else{
            #Update the new Password
            User::whereId($user->id)->update([
                'password' => Hash::make($this->new_password)
            ]);

            session()->flash("password-reset", "Password changed successfully!");
        }

        
    }


}
