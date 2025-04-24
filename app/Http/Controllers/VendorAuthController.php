<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorPasswordResetToken;
use App\Models\VerifyVendor;
use App\Notifications\SendPasswordResetLink;
use App\Notifications\VendorRegistered;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class VendorAuthController extends Controller
{
    public function showLogin(){
        return view('vendor.auth.login');
    }
    public function register(){
        return view('vendor.auth.register');
    }
    public function login(Request $request){//login

        $vendor = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
       
        if(Auth::guard('vendor')->attempt(['email'=>$vendor['email'],'password'=>$vendor['password']])){
            return redirect()->route('vendor.dashboard')->with('message','Welcome to your dashboard!');
        }else{
            return back()->with('error','Invalid email or password');
        }
    }
    public function logout(Request $request){
        Auth::guard('vendor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('vendor.login')->with('message','You are logged out!');
    }
    public function create(Request $request){

        $request->validate([
            'first_name' => 'required|min:3',
            'email' => 'required|email|lowercase',
            'password' => 'required|min:8|confirmed',

        ]);
        
        $existingVendor = Vendor::withTrashed()->where('email',$request->email)->first();
        //check whether this account already exist
        if($existingVendor){
            //check whether user had previously deleted their account
            if($existingVendor->trashed()){
                //delete old records
                $existingVendor->forceDelete();
            }else{
                //redirect user to login
                return redirect()->route('vendor.login')->with('message','A seller with this email address already exist.');
            }
        }
        
        $vendor = new Vendor;
                     
        $vendor->first_name = $request->first_name;
        $vendor->email = $request->email;
        $vendor->kitchen_banner_image="https://res.cloudinary.com/dy4k6jokm/image/upload/v1745008511/chop_a3flev.png";//default kitchen banner - cloudinary
        //$vendor->kitchen_banner_pid = "chop_a3flev";//default kitchen banner - cloudinary
        $vendor->password = Hash::make($request->password);
        $vendor->created_at = Carbon::now();

        $saved = $vendor->save();

        if($saved){
            $this->sendVerificationEmail($vendor);
            return redirect()->route('vendor.login')->with('message','You need to verify your email address! We have sent you the instructions. Please check your email.');
        }else{
            return redirect()->back()->with('error','Something went wrong, failed to register you.');
        }
    }

    public function emailVerificationNotice(){        
        return view('vendor.auth.verify-email');
    }

    public function resendEmail(){
        $vendor = Auth::guard('vendor')->user();
        if($this->sendVerificationEmail($vendor)){
            return redirect()->back()->with('message','Link sent successfully.');
        }else{
            
            return redirect()->back()->with('error','Link was not sent.');
        }
    }
    public function sendVerificationEmail($vendor){
        
        $last_id = $vendor->id;
        $token = $last_id.hash('sha256',Str::random(120));
        $actionUrl = route('vendor.verify',['token'=>$token,'service'=>'Email Service']);

        VerifyVendor::create([
            'vendor_id' => $last_id,
            'token' => $token,
        ]);

        $message = 'Thank you for signing up. We just need you to verify your email address to complete your account setup.';

        if($vendor->notify( new VendorRegistered($message,$actionUrl,$vendor->first_name))){
            //verification link was sent
            return true;
        }else{
            return false;
        }

        
    }
    public function verifyEmail(Request $request){
        $token = $request->token;
        $verifyVendor = VerifyVendor::where('token',$token)->first();

        if(!is_null($verifyVendor)){
            $vendor = $verifyVendor->vendor;
            if(!$vendor->verified){
                $verifyVendor->vendor->verified = 1;
                $verifyVendor->vendor->save();
                $this->markEmailAsVerified($vendor);
                return redirect()->route('vendor.login')->with('message','Your email is verified successfully! You can now login.')
                ->with('vendor_email',$vendor->email);

            }else{
                return redirect()->route('vendor.login')->with('message','Your email is already verified. You can now login');
            }
        }
    }
    public function markEmailAsVerified(Vendor $vendor){
        return $vendor->forceFill([
            'email_verified_at' => $vendor->freshTimestamp(),
        ])->save();
    }
    public function forgotPassword(){
        //clicks on forgot password
            return view('vendor.auth.forgot-password');
    }
    public function sendResetLink(Request $request){
        //submits email address to receive reset link
        $request->validate(['email' => 'required|email']);
        
        return $this->sendPasswordResetLink($request->email) ? back()->with('message','We have sent you the instructions to reset your password') : back()->with('error','Something went wrong, failed to send.');
    }
    public function handlePasswordReset(string $token){
        //clicks on reset password link
        return view('vendor.auth.reset-password', ['token' => $token]);
    }
    public function passwordUpdate(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        //fetch vendor
        $vendor = Vendor::where('email',$request->email)->first();

        //fetch token
        $reset = VendorPasswordResetToken::where('email',$request->email)->first();
        if($reset){
             //compare tokens
            if($request->token == $reset->token){
                //update password
                $vendor->forceFill([
                    'password' => Hash::make($request->password),
                ]);
                $saved = $vendor->save();

                if($saved){
                    //delete token
                    VendorPasswordResetToken::where('email',$request->email)->delete();

                    return redirect()->route('vendor.login')->with('message','New password was set successfully. You can login now.');
                }else{
                    return redirect()->route('vendor.password.reset')->with('error','Something went wrong, try again later!');
                }
            }else{
                return redirect()->back()->with('error','Invalid token!');
            }
        }else{
            return redirect()->back()->with('error','Token error occured!');
        }
       
    }
    public function sendPasswordResetLink($email){

        $vendor = Vendor::where('email',$email)->first();
        if(!$vendor){
            return false;
        }
        $hasToken = VendorPasswordResetToken::where('email',$email)->first();
        if($hasToken){
            return false;
        }
        $token = hash('sha256',Str::random(60));
        $actionUrl = route('vendor.password.reset',['token'=>$token]);

        VendorPasswordResetToken::create([
            'email' => $email,
            'token' => $token,
        ]);

        $message = 'Someone requested to reset your account password. If this was not you, simply ignore this email.';
        $vendor->notify( new SendPasswordResetLink($message,$actionUrl,$vendor->first_name));
        return true;
    }
}
