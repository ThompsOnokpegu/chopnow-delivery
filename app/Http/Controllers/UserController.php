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
    public function register(Request $request){

        $url = url()->previous();
       
        session(['refUrl' => $url]);//save only the path in session
        return view('frontend.user.register');
    }
    public function address(){
        return view('frontend.user.add-address');
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
       
        $user = $request->validate(['email'=>'required|lowercase','password'=>'required']);
        //attempt to login user
        if(Auth::attempt(['email'=>$user['email'],'password'=>$user['password']])){
            //extract the path of the referring url
            $path = str_replace(url('/'),'',session('refUrl'));
            //check whether the path is /login
            if($path == '/login'){
                //redirect user to home to prevent endless redirect to login
                return redirect('/');
            }
            //redirect user to the url that referred them to login
            return redirect()->route('user.address');
        }else{
            return back()->with('message','Invalid email or password');
        }
    }
}
