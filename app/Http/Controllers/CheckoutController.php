<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Auth;
use App\Repos\Paystack;
use Ramsey\Uuid\Uuid;
use App\Notifications\NewOrder;
use App\Repos\CheckoutRepo;

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
