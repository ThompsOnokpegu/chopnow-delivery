<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Vendor;
use App\Notifications\NewOrder;
use App\Repos\CheckoutRepo;
use App\Repos\Paystack;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Ramsey\Uuid\Uuid;

class ValidateCheckout extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $address2;
    public $payment_method;

    public function render()
    {
        //Initialize Cart
        $cart = $this->cart(); 
        $vendor = $this->vendor();      
        //return view
        return view('livewire.validate-checkout',compact('cart','vendor'));
    }
    public function mount(){
        $this->email = Auth::user()->email;
        $this->address = session('delivery_address');
    }
    public function placeOrder(){
        
        //validate inputs
        $validated = $this->validate(CheckoutRepo::rules());
       
        //create the order
        $order = $this->createOrder($validated);  
              
        //Check user's selected payment method
        if($validated['payment_method'] == 'Paystack'){
            //Initialize payment
            $amount = str_replace(',','', $this->cart()->getTotal());
            $vendor_id = $this->vendor()->id;
            $user = Auth::user()->name;
            $email = $validated['email'];
    
            $paystack = new Paystack();
            $response = $paystack->getPaymentLink($amount,$vendor_id,$user,$email,$order->reference);
            
            //clear cart
            $this->cart()->clear();

            //process payment: redirect to Paystack Gateway
            return redirect()->away($response['authorization_url']);   
        }else{
            //clear cart
            $this->cart()->clear();

            //redirect to home
            return redirect()->route('restaurants.index');
        }

        //send order notification - TODO: move this action to webhook
        $this->notify($order);
    }

    private function createOrder($validated){
        $uuid = Uuid::uuid4()->toString(); // Get the UUID as a string
        //create new order
        $order = new Order();
          
        $order->reference = $uuid; 
        $order->vendor_id = $this->vendor()->id;
        $order->user_id = Auth::user()->id; // Assuming a customer places the order
        $order->recipient_address = $validated['address'] .' - '.$validated['address2'];
        $order->recipient_phone = $validated['phone'];
        $order->recipient_name = $validated['name'];
        $order->order_status = "Awaiting Payment";
        $order->payment_method = $validated['payment_method'];
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
        return $order;
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
    private function notify(Order $order){
        
        $vendor = $this->vendor();
        $vendor->notify(new NewOrder($order->id));

        //send order notification - Customer
        // $user = User::where('id',Auth::user()->id);
        // $user->notify(new NewOrder($order->id));
    }
}
