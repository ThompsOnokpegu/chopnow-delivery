<?php
namespace App\Repos;

use App\Models\Order;
use App\Models\PayoutAccount;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class VendorRepo{
    public function rules(){
        return [
            'first_name' => 'min:3',
            'last_name' => 'min:3|nullable',
            'email' => 'email',
            'business_name' => 'nullable',
            'kitchen_banner_image' =>'nullable',
            'delivery_fee' => 'nullable',
            'preparation_time' => 'nullable',
            'restaurant_type' => 'nullable',
            'business_type' => 'nullable',
            'state' => ['','nullable', Rule::in(['Cross River', 'Rivers', 'Bayelsa','Akwa Ibom'])],
            'address' => 'nullable',
            'city' => 'nullable',
            'phone' => 'nullable',
            'slug' => 'nullable',
            'business_phone' => 'nullable'
        ];
    }

    public function signUpValidation(){
        return [
            'password' => ['', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ];
    }

    public function messages(){
        return [
            'kitchen_banner_image.' =>'The display image is ',    
        ];
    }

    public function fetchBanks(){
        try {
            if(VendorRepo::hasPayoutAccount(Auth::guard('vendor')->user()->id)){
                $response = Http::get('https://api.paystack.co/bank?country=nigeria&currency=NGN');
                $banks = [];
                if ($response->successful()) {
                    $data = $response->json('data');
                    // Extract the name and code of each bank
                    foreach ($data as $bank) {
                        $banks[] = [
                            'name' => $bank['name'],
                            'code' => $bank['code'],
                        ];
                    }
                } else {
                    // Handle API request failure
                    return session()->flash('error','Request failed!');
                }

                return $banks;
            }
            
        } catch (Exception $e) {
            return session()->flash('error','Connection failed!');
        }
        
    }

    public static function walletBalance($vendor){
        /*
            $vendor = Vendor:id
        */
        $orders = Order::where('vendor_id',$vendor)
            ->where('payment_status','paid')
            ->where('payment_status','cod')
            ->sum('total');

        $payouts = Transaction::where('vendor_id',$vendor)
            ->where('status','success')
            ->sum('amount');

        $balance = $orders - $payouts;

        return $balance;
    }

    public static function hasPayoutAccount($vendor){
        /*
            $vendor = Vendor:id
        */
        //fetch vendor with given id
        $payoutAccount = PayoutAccount::where('vendor_id',$vendor)->first(); 
        
        if($payoutAccount){
            return $payoutAccount;
        }
        return false;
    }

    public static function storeMenuImage($path,$requestFile){
        $file = $requestFile;
        $filename = Str::orderedUuid()->toString().'.'.$file->extension();;
        Storage::disk('local')->put($path.$filename,file_get_contents($file));
        return $filename;
    }
}
