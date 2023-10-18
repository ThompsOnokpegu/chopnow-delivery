<?php
namespace App\Repos;

use Illuminate\Validation\Rule;

class VendorRepo{
    public function rules(){
        return [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3|nullable',
            'email' => 'required|email',
            'business_name' => 'required',
            'kitchen_banner_image' =>'required|nullable',
            'state' => ['required','nullable', Rule::in(['Cross River', 'Rivers', 'Bayelsa','Akwa Ibom'])],
            'address' => 'required|nullable',
            'city' => 'required|nullable',
            'phone' => 'required',
        ];
    }

    public function messages(){
        return [
            'kitchen_banner_image.required' =>'The display image is required',    
        ];
    }

    public function resolveBank($account_number, $bank_code){

        $curl = $this->curlHead('https://api.paystack.co/bank/resolve?account_number='.$account_number.'&bank_code='.$bank_code);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
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
        // $banks  = [
        //     "status" => true,
        //     "message" => "Banks retrieved",
        //     "data" => [
        //         [
        //             "name" => "Abbey Mortgage Bank",
        //             "slug" => "abbey-mortgage-bank",
        //             "code" => "801",
        //             "longcode" => "",
        //             "gateway" => null,
        //             "pay_with_bank" => false,
        //             "active" => true,
        //             "is_deleted" => false,
        //             "country" => "Nigeria",
        //             "currency" => "NGN",
        //             "type" => "nuban",
        //             "id" => 174,
        //             "createdAt" => "2020-12-07T16:19:09.000Z",
        //             "updatedAt" => "2020-12-07T16:19:19.000Z",
        //         ],
        //         [
        //             "name" => "Coronation Merchant Bank",
        //             "slug" => "coronation-merchant-bank",
        //             "code" => "559",
        //             "longcode" => "",
        //             "gateway" => null,
        //             "pay_with_bank" => false,
        //             "active" => true,
        //             "is_deleted" => false,
        //             "country" => "Nigeria",
        //             "currency" => "NGN",
        //             "type" => "nuban",
        //             "id" => 173,
        //             "createdAt" => "2020-11-24T10:25:07.000Z",
        //             "updatedAt" => "2020-11-24T10:25:07.000Z",
        //         ],
        //         [
        //             "name" => "Infinity MFB",
        //             "slug" => "infinity-mfb",
        //             "code" => "50457",
        //             "longcode" => "",
        //             "gateway" => null,
        //             "pay_with_bank" => false,
        //             "active" => true,
        //             "is_deleted" => false,
        //             "country" => "Nigeria",
        //             "currency" => "NGN",
        //             "type" => "nuban",
        //             "id" => 172,
        //             "createdAt" => "2020-11-24T10:23:37.000Z",
        //             "updatedAt" => "2020-11-24T10:23:37.000Z",
        //         ],
        //         [
        //             "name" => "Paycom",
        //             "slug" => "paycom",
        //             "code" => "999992",
        //             "longcode" => "",
        //             "gateway" => null,
        //             "pay_with_bank" => false,
        //             "active" => true,
        //             "is_deleted" => false,
        //             "country" => "Nigeria",
        //             "currency" => "NGN",
        //             "type" => "nuban",
        //             "id" => 171,
        //             "createdAt" => "2020-11-24T10:20:45.000Z",
        //             "updatedAt" => "2020-11-24T10:20:54.000Z",
        //         ],
        //         [
        //             "name" => "Petra Mircofinance Bank Plc",
        //             "slug" => "petra-microfinance-bank-plc",
        //             "code" => "50746",
        //             "longcode" => "",
        //             "gateway" => null,
        //             "pay_with_bank" => false,
        //             "active" => true,
        //             "is_deleted" => false,
        //             "country" => "Nigeria",
        //             "currency" => "NGN",
        //             "type" => "nuban",
        //             "id" => 170,
        //             "createdAt" => "2020-11-24T10:03:06.000Z",
        //             "updatedAt" => "2020-11-24T10:03:06.000Z",
        //         ],
        //     ],
        //     "meta" => ["next" => "YmFuazoxNjk=", "previous" => null, "perPage" => 5],
        // ];
        
        //  return $banks;
    
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

    private function curlHead($endpoint){
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
