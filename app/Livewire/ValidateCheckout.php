<?php

namespace App\Livewire;

use App\Events\OrderSuccessful;
use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\NewOrder;
use App\Repos\CheckoutRepo;
use App\Repos\ChopCart;
use App\Repos\ChopNow;
use App\Repos\Paystack;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class ValidateCheckout extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $address2;
    public $payment_method;
    protected $listeners = ['address-added' => 'updateAddress'];
    private $cart;
    public $fees;

    public $alternate_name;
    public $alternate_phone;
    public $alternate_address;

    public function render()
    {                
        //return view
        $vendor = $this->cart->vendor();
        $cart = $this->cart;
        return view('livewire.validate-checkout',compact('cart','vendor'));
    }
    
    //address added listener
    public function updateAddress(){
        $this->address = session('delivery_address');
    }

    public function mount(){
        //Initialize Cart
        $this->cart = new ChopCart();
        //find the vendor whose product(s) is in cart
        $vendor = $this->cart->vendor();
        //add vendor's shipping fee to cart
        $this->cart->addShipping($vendor->delivery_fee);
        //set user's delivery details
        $this->email = Auth::user()->email;
        $this->address = session('delivery_address');
        $this->phone = session('phone');
        $this->name = Auth::user()->name;
        $this->fees = number_format(100 , 2);
    }

    public function placeOrder(){
        
        //Initialize Cart
        $this->cart = new ChopCart();
        //set delivery details
        $validated = $this->validate(['payment_method'=>'required','email'=>'email']);
             
        //Check user's selected payment method
        if($validated['payment_method'] == 'Paystack'){
            //create the order with pending status
            $order = $this->createOrder('pending');  
            
            //Initialize payment
            $amount = str_replace(',','', $this->cart->getTotal());
            $amount += $this->fees;
            $vendor_id = $this->cart->vendor()->id;
            $user = Auth::user()->name;
            $email = $validated['email'];
    
            $paystack = new Paystack();
            $response = $paystack->getPaymentLink($amount,$vendor_id,$user,$email,$order);
            
            //clear cart
            $this->cart->clear();

            //process payment: redirect to Paystack Gateway
            try {
                return redirect()->away($response['authorization_url']);
            } catch (Exception $e) {
                return session()->flash('message','Connection failed: try again later!');
            }
             
            //New order event is triggered in Webhook charge.success  
        }else{
            $order = $this->createOrder('cod'); 
            //clear cart
            $this->cart->clear();
            //trigger new order event
            OrderSuccessful::dispatch($order);
            //redirect to home
            return redirect()->route('chop.details',$order);
        }
        
        //send order notification - TODO: move this action to webhook
        //$this->notify($order);
    }

    private function createOrder($payment_status){
        //Create Cart instance
        $this->cart = new ChopCart();
        $uuid = Uuid::uuid4()->toString(); // Get the UUID as a string
        //create new order
        $order = new Order();
        //cart total
        $amount = str_replace(',','', $this->cart->getTotal());
        $amount += $this->fees;
        //set paystack and chopnow fees
        $paystack = new Paystack();
        $chopnow = new ChopNow();
        $charges = $paystack->getTransactionCharges($amount + $this->fees) + $chopnow->orderCharges($amount + $this->fees);
            
        $order_status = $payment_status == 'cod' ? 'Processing' : 'Awaiting Payment';
        DB::beginTransaction();
            //set fields
            $order->reference = $uuid; 
            $order->vendor_id = $this->cart->vendor()->id;
            $order->user_id = Auth::user()->id; // Assuming a customer places the order
            $order->recipient_address = $this->address;
            $order->recipient_phone = $this->phone;
            $order->recipient_name = $this->name;
            $order->order_status = $order_status;
            $order->payment_status = $payment_status;
            $order->payment_method = $this->payment_method;
            $order->discount = 0;
            $order->shipping = $this->cart->vendor()->delivery_fee;
            $order->total = $amount;
            $order->fees = $charges;
            //save order
            $order->save();
            
            //get cart items
            $cartItems = $this->cart->getContent();
            
            //create new order items
            foreach($cartItems as $item){
                OrderItem::create([
                    'menu_id'=> $item->id,
                    'order_id' => $order->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' =>$item->quantity,
                ]);
            }
        DB::commit();
        
        return $order;
    }
    
    private function notify(Order $order){
        //Create Cart instance
        $this->cart = new ChopCart();
        
        $vendor = $this->cart->vendor();
        $vendor->notify(new NewOrder($order->id));

        //send order notification - Customer
        // $user = User::where('id',Auth::user()->id);
        // $user->notify(new NewOrder($order->id));
    }
    
    public function setDeliveryDetails(){
        //validate inputs
        $validated = $this->validate(CheckoutRepo::rules());
   
        //replace user's delivery details
        $this->address = $validated['alternate_address'].$validated['address2'];
        $this->phone = $validated['alternate_phone'];
        $this->name = $validated['alternate_name'];
        
        session()->flash('message', 'Details added.');
    }

}
