<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\PayoutAccount;
use App\Models\RestaurantType;
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
    public function dashboard(Request $request){
        $id = Auth::guard('vendor')->user()->id;
        
        $orders = Order::where('vendor_id',$id)->get();
        $paid = $orders->where('payment_status','paid');
        $cod = $orders->where('payment_status','cod');

        //order sum
        $onlinePayment = $paid->sum('total');
        $cashPayment = $cod->sum('total');
        
        //order count
        $codOrders = $cod->count();
        $paidOrders = $paid->count();

        //customer count
        $codCustomers = Order::where('vendor_id',$id)->where('payment_status','cod')->distinct()->count('user_id');
        $paidCustomers = Order::where('vendor_id',$id)->where('payment_status','paid')->distinct()->count('user_id');


        $summary = [
            'totalSales' => $onlinePayment + $cashPayment,
            'orderCount' => $codOrders + $paidOrders,
            'productCount' => Menu::where('vendor_id',$id)->count(),
            'customerCount' => $codCustomers + $paidCustomers,
            'onlinePayment' => $onlinePayment,
            'cashPayment' => $cashPayment,
            'walletBalance' => VendorRepo::walletBalance($id),
        ];
        
        return view('vendor.index',compact('summary'));
    }

    public function profile(){
        $vendor = Auth::guard('vendor')->user();
        $restaurantTypes = RestaurantType::get();
        //dd($restaurantTypes);
        return view('vendor.profile.edit',compact('vendor','restaurantTypes'));
    }

    public function update(Request $request, Vendor $vendor, VendorRepo $val){
        $directory = 'vendor-banners';
        $request['slug'] = str()->slug($request->business_name);
        $filename = "";
        //validate input
        $validated = $request->validate($val->rules(),$val->messages());
        
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
        $validated['restaurant_type_id'] = (int)$request->restaurant_type_id;
        
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
        
        return redirect()->route('vendor.login')->with('message','Your account has been deleted!');
    }
}

