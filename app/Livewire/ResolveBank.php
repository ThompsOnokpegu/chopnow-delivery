<?php

namespace App\Livewire;

use App\Models\PayoutAccount;
use App\Models\Vendor;
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
    

    public function render(){
        $id = Auth::guard('vendor')->user()->id; 
        $hasPayoutAccount = $this->hasPayoutAccount($id);
        return view('livewire.resolve-bank',compact('hasPayoutAccount'));
    }

    public function mount(){
        $vendor = Auth::guard('vendor')->user();
        $hasPayoutAccount = $this->hasPayoutAccount($vendor->id); 
            
        if(!$hasPayoutAccount){
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
        $id = Auth::guard('vendor')->user()->id;
        //save payout account details
        $payout = PayoutAccount::create([
            'vendor_id' => $id,
            'account_name' => $payload['details']['account_name'],
            'bank_code' => $payload['details']['bank_code'],
            'bank_name' => $payload['details']['bank_name'],
            'account_number' => $payload['details']['account_number'],
            'recipient_code' => $payload['recipient_code'],
            'status' => 'verified'
        ]);

        //Approve if account is Personal Business
        $vendor = Vendor::where('id',$id)->first();
        if($vendor->business_type == "Personal"){
            $vendor->account_status = 'approved';
            $vendor->save();
        }

        $this->dispatch('payout-account-added');
    }
  
    public function hasPayoutAccount($vendor){
        /*
            $vendor = Vendor:id
        */
        //fetch vendor with given id
        $payoutAccount = PayoutAccount::where('vendor_id',$vendor)->first(); 
        
        if($payoutAccount){
            $this->account_number = $payoutAccount->account_number;
            $this->bank_name = $payoutAccount->bank_name;
            $this->account_name = $payoutAccount->account_name;
            return true;
        }
        return false;
    }
}
