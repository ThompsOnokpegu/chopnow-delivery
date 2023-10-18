@foreach($order_items as $item)

<tr>
    <td>
        <div class="d-flex justify-content-start align-items-center text-nowrap">
            <div class="avatar-wrapper">
                <div class="avatar me-2">
                    <img src="{{ asset('vendor/assets/img/avatars/1.png') }}" alt="product-Wooden Chair" class="rounded-2">
                </div>
            </div>
            <div class="d-flex flex-column">
                <h6 class="text-body mb-0">{{ $item->name }}</h6>
                <small class="text-muted">Category: Meal</small>
            </div>
        </div>
    </td>
    <td>{{ '₦'.$item->price }}</td>
    <td><span class="">{{ $item->quantity }}</span></td>
    <td><span class="">{{ '₦'.$item->quantity * $item->price }}</span></td>
</tr>

@endforeach
