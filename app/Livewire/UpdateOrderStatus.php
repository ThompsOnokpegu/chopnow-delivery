<?php

namespace App\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateOrderStatus extends Component
{
    public $order_id;
    public $order_status;
    public $comment;
    public $timeLaps;

    public function render()
    {    
        return view('livewire.update-order-status');
    }

    public function mount($order){
        $this->order_id = $order->id;
        $this->order_status = $order->order_status;
        $this->comment = $order->comment;
        //prevent order cancellation after 10mins
        $date = Carbon::parse($order->created_at);
        $now = Carbon::now();
        $this->timeLaps = $date->diffInMinutes($now);
    }

    public function updateOrderStatus(){
        $order = Order::where('id', $this->order_id)->first();        
        $validated = $this->validate([
            'order_status' => ['required', Rule::in(['Processing','Enroute', 'Delivered','Canceled'])],
        ]); 
        //check whether vendor is tring to cancel the order
        if($validated['order_status']=='Canceled'){
            $validated = $this->validate([
                'order_status' => ['required', Rule::in(['Processing','Enroute', 'Delivered','Canceled'])],
                'comment' => ['required'],
            ]);
            //check whether the order's payment method is Cash on Delivery
            if($order->payment_method == "COD"){
                //set status to Cancelled
                $order->payment_status = 'cancelled';
                $order->order_status = $validated['order_status'];
                $order->comment = $this->comment;
                $order->save();
                session()->flash('message','Order status has been updated!'); 
            }else{
                //vendor can only cancel CASH ON DELIVERY orders
                session()->flash('error','You can only cancel a Cash on Delivery order!');    
            }
        }else{

            $order->order_status = $validated['order_status'];
            $order->save();
            session()->flash('message','Order status has been updated!');          
        }
    }

}
