@component('mail::message')
# New Order {{'CN-'.$order->id  }} - ChopNow Delivery

You have a new order on your store.

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

