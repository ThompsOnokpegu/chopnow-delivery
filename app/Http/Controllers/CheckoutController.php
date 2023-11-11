<?php

namespace App\Http\Controllers;

class CheckoutController extends Controller
{

    public function checkoutPage(){    
        //return view
        return view('frontend.checkout.checkout');

    }
    public function cartPage(){
        return view('frontend.checkout.cart');
    }
   
}
