<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repos\UserRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showLogin(){
        return view('frontend.user.login');
    }
    public function register(){
        return view('frontend.user.register');
    }
    public function address(){
        return view('frontend.checkout.address');
    }

    public function create(Request $request, UserRepo $va){

        $validated = $request->validate($va->rules());
        $user = new User();
                     
        $user->name = $validated['first_name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($request->password);
        $user->created_at = Carbon::now();

        $user->save();

        return redirect()->route('user.login');
    }

    public function login(Request $request){
        $user = $request->all();
        if(Auth::attempt(['email'=>$user['email'],'password'=>$user['password']])){
            return redirect()->route('order.checkout');
        }else{
            return back()->with('message','Invalid email or password');
        }
    }
}
