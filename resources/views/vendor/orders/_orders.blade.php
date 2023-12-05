{{-- @foreach ($orders as $order)

@endforeach --}}
@forelse ($orders as $order)
<tr>
    <td><a href="{{ route('orders.detail',$order->id) }}">{{ '#'.$order->id }}</a></td>
    
    <td>{{ '₦' . $order->total - $order->discount }}</td>
    <td><span class="">{{ $order->recipient_name }}</span></td>
    <td><span class="badge bg-label-success me-1">Completed</span></td>
    <td><span class="badge bg-label-info me-1">{{ $order->order_status }}</span></td>
    <td><span class="">{{ $order->created_at->toDayDateTimeString() }}</span></td>
</tr>
@empty
    <tr>
        <td>You don't have any orders yet!</td>
    </tr>   
@endforelse
    