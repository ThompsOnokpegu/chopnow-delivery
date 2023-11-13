<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\NewOrder;
use App\Repos\CheckoutRepo;
use App\Repos\ChopCart;
use App\Repos\Paystack;
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


    public function render()
    {                
        //return view
        $vendor = $this->cart->vendor();
        $cart = $this->cart;
        return view('livewire.validate-checkout',compact('cart','vendor'));
    }
    public function updateAddress(){
        $this->address = session('delivery_address');
    }
    public function mount(){
        //Initialize Cart
        $this->cart = new ChopCart();
        //find the vendor whose product(s) is in cart
        $vendor = $this->cart->vendor();
        //add vendor's shipping fee
        $this->cart->addShipping($vendor->delivery_fee);

        $this->email = Auth::user()->email;
        $this->address = session('delivery_address');
    }
    public function placeOrder(){
        //Initialize Cart
        $this->cart = new ChopCart();
        //validate inputs
        $validated = $this->validate(CheckoutRepo::rules());
       
        //create the order
        $order = $this->createOrder($validated);  
              
        //Check user's selected payment method
        if($validated['payment_method'] == 'Paystack'){
            //Initialize payment
            $amount = str_replace(',','', $this->cart->getTotal());
            $vendor_id = $this->cart->vendor()->id;
            $user = Auth::user()->name;
            $email = $validated['email'];
    
            $paystack = new Paystack();
            $response = $paystack->getPaymentLink($amount,$vendor_id,$user,$email,$order->reference);
            
            //clear cart
            $this->cart->clear();

            //process payment: redirect to Paystack Gateway
            return redirect()->away($response['authorization_url']);   
        }else{
            //clear cart
            $this->cart->clear();

            //redirect to home
            return redirect()->route('restaurants.index');
        }

        //send order notification - TODO: move this action to webhook
        $this->notify($order);
    }
    private function createOrder($validated){
        //TODO: CREATE ORDER MUST BE A TRANSACTION
        //Create Cart instance
        $this->cart = new ChopCart();
        $uuid = Uuid::uuid4()->toString(); // Get the UUID as a string
        //create new order
        $order = new Order();
        
        DB::beginTransaction();
            $order->reference = $uuid; 
            $order->vendor_id = $this->cart->vendor()->id;
            $order->user_id = Auth::user()->id; // Assuming a customer places the order
            $order->recipient_address = $validated['address'] .' - '.$validated['address2'];
            $order->recipient_phone = $validated['phone'];
            $order->recipient_name = $validated['name'];
            $order->order_status = "Awaiting Payment";
            $order->payment_status = "pending";
            $order->payment_method = $validated['payment_method'];
            $order->discount = 0;
            $order->shipping = $this->cart->vendor()->delivery_fee;
            $order->total = str_replace(',','', $this->cart->getTotal());
            //$order->tracking_code = "CN-".rand(10111, 99999);
            $order->save();
            
            //get cart items
            $cartItems = $this->cart->getContent();
            
            //create new order items
            foreach($cartItems as $item){
                OrderItem::create([
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
    

}
