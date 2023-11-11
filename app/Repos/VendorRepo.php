<?php
namespace App\Repos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class VendorRepo{
    public function rules(){
        return [
            // 'first_name' => 'required|min:3',
            // 'last_name' => 'required|min:3|nullable',
            'email' => 'required|email',
            'business_name' => 'required',
            'kitchen_banner_image' =>'nullable',
            'delivery_fee' => 'required',
            'preparation_time' => 'required',
            'restaurant_type' => 'required',
            'business_type' => 'required',
            // 'state' => ['required','nullable', Rule::in(['Cross River', 'Rivers', 'Bayelsa','Akwa Ibom'])],
            // 'address' => 'required|nullable',
            // 'city' => 'required|nullable',
            // 'phone' => 'required',
            // 'slug' => 'required|nullable',
            // 'business_phone' => 'required|nullable'
        ];
    }

    public function signUpValidation(){
        return [
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ];
    }

    public function messages(){
        return [
            'kitchen_banner_image.required' =>'The display image is required',    
        ];
    }

    public function resolveBank($account_number, $bank_code){

        $response = Http::get('https://api.paystack.co/bank/resolve?account_number='.$account_number.'&bank_code='.$bank_code);
        if ($response->successful()) {
            $data = $response->json('data');
            return $data;
        } else {
            // Handle API request failure
            return response()->json(['error' => 'Failed to fetch banks'], $response->status());
        }
    }

    public function createRecipient($request){
        $url = "https://api.paystack.co/transferrecipient";

        $fields = [
            'type' => "nuban",
            'name' => $request->name,
            'account_number' => $request->account_number,
            'bank_code' => $request->bank_code,
            'currency' => "NGN"
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer ".env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
        ));
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        //execute post
        $result = curl_exec($ch);
        return $result;//save recipient_code to DB
    }

    public function listbanks(){
   
        $url = 'https://api.paystack.co/bank?country=nigeria&currency=NGN';
        $curl = $this->curlHead($url);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
    public function fetchBanks(){
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
            return response()->json(['error' => 'Failed to fetch banks'], $response->status());
        }

        return $banks;
    }

    public function curlHead($endpoint){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".env('PAYSTACK_SECRET_KEY'),
            "Cache-Control: no-cache",
            ),
        ));
        
        return $curl;
    }
}
