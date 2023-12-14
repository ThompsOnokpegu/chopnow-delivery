<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Repos\OrderItemsRepo;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){ 
        $vendor = Auth::guard('vendor')->user()->id;
          
        $orders = Order::where('vendor_id',$vendor)
            ->orderByDesc('created_at')
            ->get();
        foreach($orders as $order){
            $items = new OrderItemsRepo;
            $amount = $items->orderTotal($order->id);
            $order->total = $amount + $order->shipping;
            // return $order;
        }
        return view('vendor.orders.index', compact('orders'));
    }

    public function orderDetails(Order $order){

        $items = new OrderItemsRepo;
        $subtotal = $items->orderTotal($order->id);

        $order_items = OrderItem::where('order_id',$order->id)->get();
        return view('vendor.orders.order-details',compact('order_items','order','subtotal'));

    }

    public function updateOrderStatus(Request $request, Order $order){
        
        $validated = $request->validate([
            'order_status' => ['required', Rule::in(['Processing','Enroute', 'Delivered','Canceled'])],
        ]); 
        //vendor can only cancel CASH ON DELIVERY orders
        if($validated['order_status']=='Canceled'){
            if($order->payment_method == "COD"){
                $order->payment_status = 'cancelled';
            }else{
                session()->flash('message','You can only cancel a Cash on Delivery orders!');    
            }
        }
        $order->order_status = $validated['order_status'];
        $order->save();
        //session()->flash('message','Order status has been updated!');

        $vendor = Auth::guard('vendor')->user()->id; 
        $orders = Order::where('vendor_id',$vendor)->get();
        return view('vendor.orders.index',compact('orders'))->with('message','Order status has been updated');
               
    }
    public  static function statusClass($order_status){
        $bg_label = '';
        if($order_status == "Processing"){
            $bg_label = 'bg-label-primary';
        }elseif($order_status == "Delivered")
            $bg_label = 'bg-label-success';
        elseif($order_status == "Canceled"){
            $bg_label = 'bg-label-danger';
        }else{
            $bg_label = 'bg-label-info';
        }
        return $bg_label;
    }

}
