<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeactivateAccount extends Component
{
    public $confirmation;

    public function render()
    {
        return view('livewire.user.deactivate-account');
    }

    public function deactivateAccount(){

        $validated = $this->validate([
            'confirmation' => 'required',
        ]);
        
        if(strtolower($validated['confirmation']) == "delete"){
            $id = Auth::user()->id;
            User::destroy($id);
            return redirect()->route('user.login')->with('message','Your account has been deactivated!');
        }else{
            session()->flash('match','Type "DELETE" to confirm account deactivation');
        }   
    }
}
