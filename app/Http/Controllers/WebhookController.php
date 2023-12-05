<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Check if it's a POST request with Paystack signature header
        if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST' ) || !array_key_exists('HTTP_X_PAYSTACK_SIGNATURE', $_SERVER) ) {
            // Ignore other types of requests
            exit();
        }
        
        // Retrieve the payload from the request
        $payload = $request->getContent();
        
        // Retrieve the Paystack signature from the request headers
        $paystackSignature = $request->header('X-Paystack-Signature');
        
        // Calculate your own HMAC signature
        $generatedSignature = hash_hmac('sha512', $payload, env('PAYSTACK_SECRET_KEY'));

        // Verify if the Paystack signature matches the generated one
        if ($paystackSignature === $generatedSignature) {
            // Signatures match, proceed with handling the request.

            // Decode the payload as a JSON object
            $event = json_decode($payload);

            if (!$event) {
                return response('Invalid Payload', 400);
            }

            // Retrieve the reference from the Paystack event
            $reference = $event->data->reference;
 
            switch ($event->event) {
                case 'charge.success':
                    return response('Webhook Processed', 200);
                    // Find the order associated with the reference
                    $order = Order::where('reference', $reference)->first();
                    if ($order) {
                        // Update the order status to 'Processing' and save it
                        $order->order_status = 'Processing';
                        $order->payment_status = 'paid';
                        $order->save();
                        
                    }
                    break;
                case 'transfer.success':
                    return response('Webook Processed', 200);
                    // Handle transfer.success
                    $transaction = Transaction::where('reference',$reference)->first();
                    if($transaction){
                        $transaction->status = $event->data->status;
                        $transaction->save();
                       
                    }
                    break;
            }
        } else {
            // Signatures do not match, reject the request.

            // Log this event for investigation.
            Log::warning('Paystack HMAC signature does not match');

            abort(400); // Or return a suitable response
        }           
    }   
}
