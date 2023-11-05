<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function show(){
        //Initialize Cart
        $cart = $this->cart(); 
        $vendor = $this->vendor();      
        //return view
        return view('frontend.checkout.checkout',compact('cart','vendor'));

    }

    public function placeorder(Request $request){
        //create new order
        $order = new Order();
        
        $order->vendor_id = $this->vendor()->id;
        $order->user_id = Auth::user()->id; // Assuming a customer places the order
        $order->recipient_address = $request->address1 .' - '.$request->address2;
        $order->recipient_phone = $request->phone;
        $order->recipient_name = $request->name;
        $order->order_status = "Processing";
        $order->payment_method = "COD";
        $order->discount = 0;
        //$order->tracking_code = "CN-".rand(10111, 99999);
        $order->save();
        
        //get cart items
        $cartItems = $this->cart()->getContent();

        //create new order items
        foreach($cartItems as $item){
            $vendor = $item->associatedModel->vendor_id;
            OrderItem::create([
                'order_id' => $order->id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' =>$item->quantity,
                //'total' => $item->getPriceSum(),//price*quanity
            ]);
        }

        //clear cart
        $this->cart()->clear();

        //send order notification - Vendor

        //send order notification - Customer

        //redirect to home
        return redirect(route('restaurants.index'));
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
            'order' => 2 // the order of calculation of cart base conditions. The bigger the later to be applied.
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

    public function showCart(){
        return view('frontend.checkout.cart');
    }
}
