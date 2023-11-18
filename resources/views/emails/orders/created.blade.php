@component('mail::message')
# Order {{'CN-'.$order->id  }} Received - ChopNow Delivery

Your order has been received.

Order Details:<br>
@foreach ($items as $item)
    {{ $item->name  }} x {{ $item->quantity }} - {{ $item->price * $item->quantity }}<br>
@endforeach

-Subtotal: {{ $order->total - $order->shipping }}<br>
-Shipping: {{ $order->shipping }}<br>
-Total: {{ $order->total }}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

