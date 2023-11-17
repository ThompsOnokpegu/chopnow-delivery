<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repos\UserRepo;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showLogin(Request $request){
        //keep previous url to determine where to redirect the user after login flow
        $url = url()->previous();
       
        session(['refUrl' => $url]);//save only the path in session
        return view('frontend.user.login');
    }

    public function register(){
        return view('frontend.user.register');
    }

    public function address(){
        //keep previous url to determine where to redirect the user after verification flow
        $url = url()->previous();
       
        session(['refUrl' => $url]);//save only the path in session

        return view('frontend.checkout.add-address');
    }

    public function create(Request $request, UserRepo $va){

        $validated = $request->validate($va->rules());
        $user = new User();
                     
        $user->name = $validated['first_name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($request->password);
        $user->created_at = Carbon::now();
        $user->save();

        //send verification email
        event(new Registered($user));

        return redirect()->route('user.login');
    }
    //email verification
    public function emailVerificationNotice(){
        //keep previous url to determine where to redirect the user after verification flow
        $url = url()->previous();
       
        session(['refUrl' => $url]);//save only the path in session
        return view('frontend.user.verify-email');
    }

    public function emailVerificationHandler(EmailVerificationRequest $request) {

        $request->fulfill();
        return redirect()->route('user.address');
    }

    public function resendEmailLink(Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    }
    //end email verification

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login')->with('message','You are logged out');
    }

    

}
