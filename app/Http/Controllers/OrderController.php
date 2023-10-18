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
          
        $orders = Order::where('vendor_id',$vendor)->get();
        foreach($orders as $order){
            $items = new OrderItemsRepo;
            $amount = $items->orderTotal($order->id);
            $order->total = $amount;
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
        $order->update($validated);

        $vendor = Auth::guard('vendor')->user()->id; 
        $orders = Order::where('vendor_id',$vendor)->get();
        return view('vendor.orders.index',compact('orders'))->with('message','Order status has been updated');
               
    }
}
