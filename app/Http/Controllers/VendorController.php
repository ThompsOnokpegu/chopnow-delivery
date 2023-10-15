<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Repos\VendorRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
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
    
    public function compliance(){
        return view('vendor.profile.compliance');
    }
    
}

