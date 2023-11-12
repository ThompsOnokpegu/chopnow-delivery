<?php

namespace App\Livewire;

use App\Models\PayoutAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ResolveBank extends Component
{
    public $account_number='';
    public $bank_code = '';
    public $bank_name = '';
    public $account_name = '';
    public $banks = '';
    public $paystack = 'https://api.paystack.co';
    


    public function mount(){
        $vendor = Auth::guard('vendor')->user();
        $payout = PayoutAccount::where('vendor_id',$vendor->id)->first(); 
            
        if($payout!=null){
            $this->account_name = $payout->account_name;
            $this->account_number = $payout->account_number;
            $this->bank_name = $payout->bank_name;
        }else{
            $response = Http::get($this->paystack.'/bank?country=nigeria&currency=NGN');
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
    
            $this->banks = $banks;
        }
    }


    public function resolve(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.env('PAYSTACK_SECRET_KEY'),
            'Content-Type' => 'application/json',
        ])->get($this->paystack.'/bank/resolve?account_number='.$this->account_number.'&bank_code='.$this->bank_code);

        if ($response->successful()) {
            $data = $response->json('data');
            $this->account_name = $data['account_name'];
            $this->createTransferRecipient();
        } else {
            // Handle API request failure
            return response()->json(['error' => 'Failed to fetch banks'], $response->status());
        }
    }

    private function createTransferRecipient(){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.env('PAYSTACK_SECRET_KEY'), 
            'Content-Type' => 'application/json', 
        ])->post($this->paystack.'/transferrecipient', [
            "type" => "nuban", 
            "name" => $this->account_name, 
            "account_number" => $this->account_number, 
            "bank_code" => $this->bank_code, 
            "currency" => "NGN"
        ]);
    
        if ($response->successful()) {
            $responseData = $response->json();
            $this->setVendorPayoutAccount($responseData['data']);
            // Handle the response data here
        } else {
            // Handle API request failure
            return response()->json(['error' => 'Failed to send POST request'], $response->status());
        }

    }

    private function setVendorPayoutAccount($payload){
        $vendor = Auth::guard('vendor')->user();
        $payout = PayoutAccount::create([
            'vendor_id' => $vendor->id,
            'account_name' => $payload['details']['account_name'],
            'bank_code' => $payload['details']['bank_code'],
            'bank_name' => $payload['details']['bank_name'],
            'account_number' => $payload['details']['account_number'],
            'recipient_code' => $payload['recipient_code'],
            'status' => 'verified'
        ]);
        $this->bank_name = $payout->bank_name;
        $this->account_name = $payout->account_name;
        $this->dispatch('payout-account-added');
    }

    public function render(){
        $account_name = $this->account_name;
        return view('livewire.resolve-bank',compact('account_name'));
    } 
}
