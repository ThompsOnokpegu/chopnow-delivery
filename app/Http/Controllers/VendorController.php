<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Repos\VendorRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class VendorController extends Controller
{
    //edited manifest.json and ran npm run build
    public function login(){
        return view('vendor.login');
    }

    public function dashboard(){
        return view('vendor.index');
    }

    public function verify(Request $request){
        $vendor = $request->all();
        if(Auth::guard('vendor')->attempt(['email'=>$vendor['email'],'password'=>$vendor['password']])){
            return redirect()->route('vendor.dashboard')->with('message','Login successful');
        }else{
            return back()->with('message','Invalid email or password');
        }
    }

    public function logout(Request $request){
        Auth::guard('vendor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('vendor.login')->with('message','You are logged out');
    }

    public function register(){
        return view('vendor.register');
    }

    public function create(Request $request){
        $vendor = new Vendor;
 
        $vendor->first_name = $request->first_name;
        $vendor->email = $request->email;
        $vendor->password = Hash::make($request->password);
        $vendor->created_at = Carbon::now();

        $vendor->save();

        return redirect()->route('vendor.login');
    }

    public function profile(){
        $vendor = Auth::guard('vendor')->user();
        return view('vendor.profile.edit',compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor, VendorRepo $val){
        $validated = $request->validate($val->rules(),$val->messages());
       
        $vendor->update($validated);
        return redirect()->route('vendor.profile')->with('message','Details updated successfully!');
    }

    public function changePassword(){
        return view('vendor.profile.authentication');
    }
    public function resetPassword(Request $request){
        
        $vendor = Auth::guard('vendor')->user();
        # Validation
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required','confirmed',Password::defaults()],
        ]);

        
        #Match The Old Password
        if(!Hash::check($request->current_password, $vendor->password)){
            return back()->with("error", "Old password doesn't match!");
        }


        #Update the new Password
        Vendor::whereId($vendor->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
    
    public function compliance(){
        return view('vendor.profile.compliance');
    }

    
    public function payout(VendorRepo $VendorRepo){
        $vendor = Auth::guard('vendor')->user();  
        //$banks = $VendorRepo->fetchBanks(); 
        return view('vendor.profile.account-validation',compact('vendor'));
    }

    public function verifyBank(Request $request, VendorRepo $VendorRepo){
        $account_number = $request->account_number;
        $bank_code = $request->bank_code;

        $data = $VendorRepo->resolveBank($account_number,$bank_code);

        return view('vendor.profile.account-validation',compact('data'));
    }

    
    public function createRecipient(){
        $vendor = Auth::guard('vendor')->user();
        
        return view('vendor.profile.account-validation',compact('vendor'));
    }
}

