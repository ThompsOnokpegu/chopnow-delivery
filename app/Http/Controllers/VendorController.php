<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\PayoutAccount;
use App\Models\Vendor;
use App\Repos\VendorRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    //edited manifest.json and ran npm run build
    public function login(){
        return view('vendor.login');
    }

    public function dashboard(){
        $id = Auth::guard('vendor')->user()->id;
        $orders = Order::where('vendor_id',$id)->get();
       
        $onlinePayment = $orders->where('payment_status','paid')->sum('total');
        $cashPayment = $orders->where('payment_status','cod')->sum('total');

        $summary = [
            'totalSales' => $onlinePayment + $cashPayment,
            'orderCount' => $orders->count(),
            'productCount' => Menu::where('vendor_id',$id)->count(),
            'customerCount' => Order::where('vendor_id',$id)->distinct()->count('user_id'),
            'onlinePayment' => $onlinePayment,
            'cashPayment' => $cashPayment,
            'walletBalance' => VendorRepo::walletBalance($id),
        ];
        
        return view('vendor.index',compact('summary'));
    }

    public function verify(Request $request){

        $vendor = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

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

        $request->validate([
            'first_name' => 'required|min:3',
            'email' => 'required|email|lowercase',
            'password' => 'required|min:8|confirmed',

        ]);
        
        $vendor = new Vendor;
                     
        $vendor->first_name = $request->first_name;
        $vendor->email = $request->email;
        $vendor->kitchen_banner_image="brand-image.png";
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
        $directory = 'vendor-banners';
        $request['slug'] = str()->slug($request->business_name);
        $filename = "";
        //validate input
        $validated = $request->validate($val->rules(),$val->messages());

        
        // //check whether vendor uploaded a new image for this vendor
        // if($request->hasFile('kitchen_banner_image')){
            
        //     //check if the old image is still in the directory: prevent file not found exception
        //     if(Storage::disk('local')->exists('public/vendor-banners/'.$vendor->kitchen_banner_image)){
        //         //delete old image
        //         Storage::disk('local')->delete('public/vendor-banners/'.$vendor->kitchen_banner_image);
        //         //upload the new file
        //         $filename = VendorRepo::storeMenuImage($directory,$request->file('kitchen_banner_image'));
        //     }
        //     //upload the new file
        //     $filename = VendorRepo::storeMenuImage($directory,$request->file('kitchen_banner_image'));
            
        // }else{
        //     //product image did not change
        //     $filename = $vendor->kitchen_banner_image;   
        // }
        
        //check whether vendor uploaded a new image for this vendor
        if($request->hasFile('kitchen_banner_image')){
            //upload the file to cloudinary
            $filename = VendorRepo::cloudinaryUpload($directory,$validated['kitchen_banner_image']);
        }else{
            //product image did not change
            $filename = $vendor->kitchen_banner_image;
        }
        

        //update the file name
        $validated['kitchen_banner_image'] = $filename;
        
        //update the vendor record
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
        $banks = $VendorRepo->fetchBanks(); 
        return view('vendor.profile.account-validation',compact('vendor','banks'));
    }

    public function deactivateAccount(Request $request){

        $validated = $request->validate([
            'confirm' => 'required',
        ]);
        
        if(strtolower($validated['confirm']) == "delete"){
            $id = Auth::guard('vendor')->user()->id;
            Vendor::destroy($id);
        }
        
        return redirect()->route('vendor.login');
    }
}

