<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\PayoutAccount;
use App\Models\Transaction;
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
        $id = Auth::guard('vendor')->user()->id;
        $balance = VendorRepo::walletBalance($id);
        if($balance < $this->amount ){
            return session()->flash('error','Insufficient balance!');
        }
        if(($balance - $this->amount) < 1000){
            return session()->flash('error','You must maintain a minimum balance of ₦1,000');
        }
        try {
            $ref  = Uuid::uuid4()->toString(); // Get the UUID as a string
            $endpoint = 'https://api.paystack.co/transfer';

            
            $vendorAccount = PayoutAccount::where('vendor_id',$id)->first();
            // dd($this->amount);
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.env('PAYSTACK_SECRET_KEY'), 
                'Content-Type' => 'application/json', 
            ])->post($endpoint, [
                'source'=> 'balance', 
                'reason' => 'ChopNow Payout', 
                'amount' => $this->amount* 100, 
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
                
            } else {
                // Handle API request failure
                return response()->json(['error' => 'Failed to send POST request'], $response->status());
            }
        } catch (Exception $e) {
            // Handle exceptions, log them, or return an error response
        }
        
    }
    public function getBalance($vendor){
        /*
            $vendor = Vendor:id
        */
        $orders = Order::where('vendor_id',$vendor)
            ->where('payment_status','paid')
            ->get();

        $payouts = Transaction::where('vendor_id',$vendor)
            ->where('status','success')
            ->get();

        $order_sum = 0;
        foreach($orders as $order){
            $order_sum += $order->total;
        }
        $payout_sum = 0;
        foreach($payouts as $payout){
            $payout_sum += $payout->amount;
        }

        $balance = $order_sum - $payout_sum;

        return $balance;
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
