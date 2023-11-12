<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\PayoutAccount;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Ramsey\Uuid\Uuid;

class RequestPayout extends Component
{
    public $amount;
    private $data;
    public $payoutAccount;
    protected $listeners = ['payout-account-added' => 'render'];//I want you to eavesdrop on ResolveBank
    public function render()
    {
        $id = Auth::guard('vendor')->user()->id;
        //check whether payout account has been set
        $payout = PayoutAccount::where('vendor_id',$id)->first(); 
        
        $data = $this->data;
        $balance = $this->getBalance($id);
        return view('livewire.request-payout',compact('data','balance','payout'));
    }

    public function transfer(){
        try {
            $ref  = Uuid::uuid4()->toString(); // Get the UUID as a string
            $endpoint = 'https://api.paystack.co/transfer';

            $id = Auth::guard('vendor')->user()->id;
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
                // Handle the response data here
            } else {
                // Handle API request failure
                return response()->json(['error' => 'Failed to send POST request'], $response->status());
            }
        } catch (Exception $e) {
            // Handle exceptions, log them, or return an error response
        }
        
    }
    public function getBalance($vendor){

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
}
