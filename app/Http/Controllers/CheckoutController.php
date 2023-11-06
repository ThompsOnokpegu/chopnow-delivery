<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Auth;
use App\Repos\Paystack;
use Ramsey\Uuid\Uuid;

class CheckoutController extends Controller
{

    public function checkoutPage(){
        //Initialize Cart
        $cart = $this->cart(); 
        $vendor = $this->vendor();      
        //return view
        return view('frontend.checkout.checkout',compact('cart','vendor'));

    }
    public function cartPage(){
        return view('frontend.checkout.cart');
    }

    public function placeOrder(Request $request){
        $uuid = Uuid::uuid4()->toString(); // Get the UUID as a string
        //create new order
        $order = new Order();
          
        $order->reference = $uuid; 
        $order->vendor_id = $this->vendor()->id;
        $order->user_id = Auth::user()->id; // Assuming a customer places the order
        $order->recipient_address = $request->address1 .' - '.$request->address2;
        $order->recipient_phone = $request->phone;
        $order->recipient_name = $request->name;
        $order->order_status = "Awaiting Payment";
        $order->payment_method = "COD";
        $order->discount = 0;
        //$order->tracking_code = "CN-".rand(10111, 99999);
        $order->save();
        
        //get cart items
        $cartItems = $this->cart()->getContent();

        //create new order items
        foreach($cartItems as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' =>$item->quantity,
                //'total' => $item->getPriceSum(),//price*quanity
            ]);
        }

        // //send order notification - Vendor

        // //send order notification - Customer

        //process payment
        $amount = str_replace(',','', $this->cart()->getTotal());
        $vendor_id = $this->vendor()->id;
        $user = Auth::user()->name;
        $email = $request->email;
        
        //clear cart
        $this->cart()->clear();

        $paystack = new Paystack();
        $response = $paystack->getPaymentLink($amount,$vendor_id,$user,$email,$uuid);
        return redirect()->away($response['authorization_url']);   
    }

    private function cart(){ 
        $config = [
            'format_numbers' => true,
            'decimals' => 2,
            'dec_point' => '.',
            'thousands_sep' => ',',
        ]; 

        $cart = new Cart(app('session'), app('events'), 'default', 'cart', $config);  
        // add condition to only apply on totals, not in subtotal
        $condition = new CartCondition(array(
            'name' => 'Delivery ₦750',
            'type' => 'shipping',
            'target' => 'total', // this condition will be applied to cart's total when getTotal() is called.
            'value' => '+750',
            'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
        ));
        // $condition2 = new CartCondition(array(
        //     'name' => 'VAT 7.5%',
        //     'type' => 'tax',
        //     'target' => 'total', // this condition will be applied to cart's total when getTotal() is called.
        //     'value' => '7.5%',
        //     'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
        // ));
        
        $cart->condition($condition);
        
        return $cart;
    }

    private function vendor(){
        $vendor_id = "";
         //Initialize Cart
         $cart = $this->cart();

         //find the vendor that owns the menu items
         $items = $cart->getContent();
         foreach($items as $item){
             $vendor_id = $item->associatedModel->vendor_id;
             break;
         }
         $vendor = Vendor::where('id',$vendor_id)->first();
       
         return $vendor;
    }

    
}
