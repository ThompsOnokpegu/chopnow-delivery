@component('mail::message')
# Order {{'CN-'.$order->id  }} Received.

Your order has been received.

#Order Details:<br>
@component('mail::table')
    | Item       | Qty         | Price  |
    |:------------- |:-------------| --------:|
    @foreach ($items as $item)
        | {{ $item->name  }}      | {{ $item->quantity }} | ₦{{ $item->price * $item->quantity }}      |
    @endforeach
    | Subtotal      | ₦{{ number_format($order->total - $order->shipping - 100,2) }}      |
    | Shipping      | ₦{{ number_format($order->shipping,2) }}      |
    | Services      | ₦{{ number_format(100,2) }}      |
    | Total         | ₦{{ number_format($order->total,2) }}      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

