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
            //'email' => 'email',
            'business_name' => 'required',
            'kitchen_banner_image' =>'nullable',
            'delivery_fee' => 'nullable',
            'preparation_time' => 'nullable',
            'restaurant_type_id' => 'nullable',
            'business_type' => 'nullable',
            'state' => ['','nullable', Rule::in(['Cross River'])],
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
            ->where('payment_method','Paystack')
            ->where('payment_status','paid')
            ->sum('total');

        $payouts = Transaction::where('vendor_id',$vendor)
            ->where('status','success')
            ->sum('amount');

        $codFees = Order::where('vendor_id',$vendor)
            ->where('payment_status','cod')   
            ->sum('fees');

        $paidFees = Order::where('vendor_id',$vendor)
            ->where('payment_status','paid')  
            ->sum('fees');
            
        $fees = $codFees + $paidFees;

        $balance = $orders - ($fees + $payouts);

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

    // public static function storeMenuImage($path,$requestFile){
    //     $file = $requestFile;
    //     $filename = Str::orderedUuid()->toString().'.'.$file->extension();;
    //     Storage::disk('local')->put($path.$filename,file_get_contents($file));
    //     return $filename;
    // }

    public static function cloudinaryUpload($path,$file){
        // First we validate the input from the user
        // $data = $file->validate([
        //   'media' => [
        //     'required',
        //     'image',
        //     'mimes:jpeg,jpg,png',
        //     ],
        // ]);
        /*Set the transformations required to optimize the images based on recommended optimization*/
        if($path=='menu-images'){
            $folder = $path;
            $media = $file;
            $width = '800';
            $height = '800';
            $quality = 'auto';
            $fetch = 'auto';
            $crop = 'scale';
        }else{
            $folder = $path;
            $media = $file;
            $width = '1053';
            $height = '468';
            $quality = 'auto';
            $fetch = 'auto';
            $crop = 'scale';
        }
        //upload the image to clouldinary
        $uploadedFileUrl = cloudinary()->upload($media->getRealPath(),[
            'folder' => 'chopnow/'.$folder,
            'transformation' => [
                'width'   => $width,
                'height'  => $height,
                'quality' => $quality,
                'fetch'   => $fetch,
                'crop'    => $crop
            ]
        ])->getSecurePath();

        $dbUrl = Str::after($uploadedFileUrl, 'upload/');//"v1700736919/vendor-banners/ei4lfu3nwxsnrxfsrgv3.jpg"
        
        return $dbUrl;
    }
}
