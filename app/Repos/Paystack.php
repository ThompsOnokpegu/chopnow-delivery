<?php

namespace App\Repos;

use Illuminate\Support\Facades\Http;
use Throwable;

class Paystack {
    
    private $api = 'https://api.paystack.co';
    
    public function getPaymentLink($amount, $vendor_id, $user, $email, $order) {
        
        //set callback url
        $callback_url = url(route('chop.details',$order));
        //$callback_url = 'https://8b35-102-91-54-66.ngrok-free.app';
        // Set the API endpoint
        $endpoint = $this->api . '/transaction/initialize';
        //$callback = url(route('restaurants.index'));//TODO: CHANGE TO THANKYOU PAGE
        
        // Define metadata for the payment
        $metadata = [
            'metadata' => [
                'cart_id' => 398, // Replace with an order id
                'custom_fields' => [
                    [
                        'display_name' => 'First Name',
                        'variable_name' => 'first_name',
                        'value' => $user,
                    ],
                    [
                        'display_name' => 'Vendor ID',
                        'variable_name' => 'vendor_id',
                        'value' => $vendor_id,
                    ],
                ],
            ],
        ];
        // Prepare the request data
        $requestData = [
            'email' => $email,
            'amount' => $amount * 100, // Paystack expects the amount in kobo
            'reference' => $order->reference,
            'callback_url' => $callback_url,
            'currency' => 'NGN',
            'metadata' => $metadata['metadata'],
        ];
        
        try {
            // Make the API call to Paystack
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
                'Content-Type' => 'application/json',
            ])->post($endpoint, $requestData);
        } catch (Throwable $e) {
            // Handle exceptions here, e.g., log the error and return an appropriate response
            return session()->flash('message','Something went wrong! Try again later.');
        }

        if ($response->successful()) {
            $data = $response->json('data');
            return $data;
        } else {
            // Handle API request failure, return an appropriate response
            return session()->flash('message','Connection failed!');
        }
        
    }

    public function getTransactionCharges($amount){
        $fees = 0;
        $charges = ($amount * 0.015) + 100;  //For Local Transactions 1.5% + NGN 100
        $cap = 2000; //Local transactions fees are capped at ₦2000, 

        $fees = $charges;

        if($amount < 2500){   
            //₦100 fee waived for transactions under ₦2500
            $fees = $charges - 100;
        }

        if($charges > $cap){
            // 2000 is the absolute maximum you'll ever pay in fees per transaction
            $fees = 2000;
        }

        return $fees;

    }
    
    public function getTransferCharges($amount){
        $fees = 0;
        /*
            Transfers of NGN 5,000 and below = NGN 10 per Transfer
            Transfers between NGN 5,001 and NGN 50,000 = NGN 25 per Transfer
            Transfers above NGN 50,000 = NGN 50 per Transfer
        */
        if($amount <= 5000){
            $fees = 10;
        }

        if($amount > 5000 && $amount <= 50000){
            $fees = 25;
        }

        if($amount > 50000 ){
            $fees = 50;
        }

        return $fees;
    }
}
