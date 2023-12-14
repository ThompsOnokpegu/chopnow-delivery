<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\PayoutAccount;
use App\Models\Transaction;
use App\Repos\Paystack;
use App\Repos\VendorRepo;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Ramsey\Uuid\Uuid;

class RequestPayout extends Component
{
    public $amount;
    private $data;
    protected $listeners = ['payout-account-added' => 'render'];//I want you to eavesdrop on ResolveBank
    public function render()
    {
        $id = Auth::guard('vendor')->user()->id;
        //check whether payout account has been set
        $hasPayoutAccount = $this->hasPayoutAccount($id); 
        
        $data = $this->data;
        $balance = VendorRepo::walletBalance($id);
        return view('livewire.request-payout',compact('data','balance','hasPayoutAccount'));
    }

    public function transfer(){
        $paystack = new Paystack;
        $amount = $this->amount + $paystack->getTransferCharges($this->amount);
        $vendor = Auth::guard('vendor')->user();
        $id = $vendor->id;
        //get vendor's balance
        $balance = VendorRepo::walletBalance($id);
        //check whether vendor has sufficient balance
        if($balance < $amount ){
            return session()->flash('error','Insufficient balance!');
        }
        //check whether vendor meet minimum balance
        if(($balance - $amount) < 1000){
            return session()->flash('error','You must maintain a minimum balance of ₦1,000');
        }
        //check whether vendor type is Registered Business
        if($vendor->business_type == "Registered"){
            $isApproved = $vendor->kyc_document ?? $vendor->kyc_number ?? false;
            //check whether vendor meet KYC compliance
            if($isApproved==false){
                return session()->flash('error','You have not submitted your business registration document!');
            }else{
                //check whether vendor kyc has been approved
                if($vendor->account_status!="Approved"){
                    return session()->flash('error','Your KYC document is under review!');
                }
            }

        }

        try {
            $ref  = Uuid::uuid4()->toString(); // Get the UUID as a string
            $endpoint = 'https://api.paystack.co/transfer';

            
            $vendorAccount = PayoutAccount::where('vendor_id',$id)->first();
            // dd($amount);
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.env('PAYSTACK_SECRET_KEY'), 
                'Content-Type' => 'application/json', 
            ])->post($endpoint, [
                'source'=> 'balance', 
                'reason' => 'ChopNow Payout', 
                'amount' => $amount* 100, 
                'reference' => $ref,
                'recipient' => $vendorAccount->recipient_code,
            ]);
            if ($response->successful()) {
                // Handle the response data here
                $data = $response->json()['data'];
                $transaction = Transaction::create([
                    'vendor_id'=>$id,
                    'reference' => $data['reference'],
                    'transfer_code' => $data['transfer_code'],
                    'type' => $data['reason'],
                    'amount' => $data['amount']/100,
                    'status' => $data['status'],
                ]); 
                $this->data = $transaction;
                return session()->flash('message','Transfer successful!');
            } else {
                // Handle API request failure
                return session()->flash('error','Transfer failed!');
            }
        } catch (Exception $e) {
            // Handle exceptions, log them, or return an error response
            return session()->flash('error','Something went wrong, try again later!');
        }
        
    }

    public function hasPayoutAccount($vendor){
        /*
            $vendor = Vendor:id
        */
        //fetch vendor with given id
        $payoutAccount = PayoutAccount::where('vendor_id',$vendor)->first(); 
        
        if($payoutAccount){
            return true;
        }
        return false;
    }
}
