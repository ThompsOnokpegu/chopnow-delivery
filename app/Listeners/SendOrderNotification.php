<?php

namespace App\Listeners;

use App\Mail\UserPurchaseNotice;
use App\Mail\VendorOrderNotice;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification
{
    
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $order = $event->order;
        $items = OrderItem::where('order_id',$order->id)->get();

        Mail::to($order->user->email)->send(new UserPurchaseNotice($order,$items));
        //Mail::to($order->vendor->email)->send(new VendorOrderNotice($order,$items));
    }
}
