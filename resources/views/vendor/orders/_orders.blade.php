{{-- @foreach ($orders as $order)

@endforeach --}}
@forelse ($orders as $order)
<tr>
    <td><a href="{{ route('orders.detail',$order->id) }}" style="text-decoration:underline;">{{ '#'.$order->id }}</a></td>
    
    <td>{{ '₦' . $order->total - $order->discount }}</td>
    <td>{{ $order->fees }}</td>
    <td><span class="badge {{ App\Http\Controllers\OrderController::statusClass($order->order_status) }} me-1">{{ $order->order_status }}</span></td>
    <td>{{ $order->payment_method == 'COD' ? 'Cash on Delivery' : $order->payment_method }}</td>
    <td>{{ $order->recipient_name }}</td>
    <td><span class="">{{ $order->created_at->toDayDateTimeString() }}</span></td>
</tr>
@empty
    <tr>
        <td>You don't have any orders yet!</td>
    </tr>   
@endforelse
    