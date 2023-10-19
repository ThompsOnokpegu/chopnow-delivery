<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ResolveBank extends Component
{
    public $account_number='0116961717';
    public $bank_code = '058';
    public $account_name = '';

    public function resolve(){
        $response = Http::get('https://api.paystack.co/bank/resolve?account_number='.$this->account_number.'&bank_code='.$this->bank_code);
        if ($response->successful()) {
            $data = $response->json('data');
            $this->account_name = $data['account_name'];
        } else {
            // Handle API request failure
            return response()->json(['error' => 'Failed to fetch banks'], $response->status());
        }
    }

    public function render()
    {
        $account = $this->account_name;
        return view('livewire.resolve-bank',compact('account'));
    }
}
