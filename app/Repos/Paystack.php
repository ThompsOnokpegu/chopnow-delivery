<?php

namespace App\Repos;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class Paystack {
    
    private $api = 'https://api.paystack.co';
    
    public function getPaymentLink($amount, $vendor_id, $user, $email, $order) {
        try {
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

            // Make the API call to Paystack
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
                'Content-Type' => 'application/json',
            ])->post($endpoint, $requestData);

            if ($response->successful()) {
                $data = $response->json('data');
                return $data;
            } else {
                // Handle API request failure, return an appropriate response
                return response()->json(['error' => $response], $response->status());
            }
        } catch (RequestException $e) {
            // Handle exceptions here, e.g., log the error and return an appropriate response
            return response()->json(['error' => 'Failed to make API request'], 500);
        }
    }
}
