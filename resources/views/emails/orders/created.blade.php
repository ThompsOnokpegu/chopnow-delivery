@component('mail::message')
# Order {{'CN-'.$order->id  }} Received - ChopNow Delivery

Your order has been received.

#Order Details:<br>
@component('mail::table')
    | Item       | Qty         | Price  |
    | ------------- |:-------------:| --------:|
    @foreach ($items as $item)
        | {{ $item->name  }}      | {{ $item->quantity }} | ₦{{ $item->price * $item->quantity }}      |
    @endforeach
    | Subtotal      | ₦{{ $order->total - $order->shipping }}      |
    | Shipping      | ₦{{ $order->shipping }}      |
    | Total         | ₦{{ $order->total }}      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

