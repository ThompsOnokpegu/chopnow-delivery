<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Vendor;
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
        $user = Auth::user();

        if($user->street == null || $user->phone == null ){
            return view('frontend.checkout.add-address');
        }

        session(['delivery_address' => $user->street]);
        session(['phone' => $user->phone]);
        //extract the path of the referring url
        $path = str_replace(url('/'),'',session('refUrl'));
        //Check whether user was trying to checkout
        if($path == '/cart'){
            //redirect to checkout
            return redirect()->route('order.checkout');
        }
        return redirect()->route('restaurants.index');
        
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

    public function userProfile(){
        $vendor = Vendor::where('id',2)->first();
        return view('frontend.user.user-profile',compact('vendor'));
    }

    public function deactivateAccount(Request $request){

        $validated = $request->validate([
            'confirmation' => 'required',
        ]);
        
        if(strtolower($validated['confirmation']) == "delete"){
            $id = Auth::user()->id;
            User::destroy($id);
        }
        
        return redirect()->route('user.login')->with('message','Your account has been deactivated!');
    }

}
