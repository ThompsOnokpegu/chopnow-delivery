<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function checkoutPage(){    
        //return view
        return view('frontend.checkout.checkout');

    }
    public function cartPage(){
        return view('frontend.checkout.cart');
    }

    public function thankYou(Request $request){
        if ($request->isMethod('get')) {
            $reference = $request->query('reference');
            $order = Order::where('reference',$reference)->first()->id;
            
            return view('frontend.checkout.thank-you', compact('reference','order'));
        }
       
    }
   
}
