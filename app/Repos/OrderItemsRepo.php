<?php
namespace App\Repos;

use App\Models\Menu;
use App\Models\OrderItem;

class OrderItemsRepo{

    public function orderTotal($order_id){
        //retrieve order items
        $amount = 0;
        $order_items = OrderItem::where('order_id',$order_id)->get();
        foreach($order_items as $item){
            $amount += $item->quantity * $item->price;
        }
        return $amount;
    }
    
}