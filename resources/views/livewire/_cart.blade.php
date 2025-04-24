<div class="container">
    <div class="modal-header" style="border-bottom:0px;">
        <h5 class="modal-title">Basket</h5>
        @if(url()->current() != route('order.cart'))
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        @endif
        
    </div>
    @if ($cart->isEmpty())
        <div class="d-flex bd-highlight mb-5 mt-5 ">
            <div class="p-5 bd-highlight flex-shrink-0 text-center">
                <p class="">Your cart is empty! <span><a class="btn-white w-100" style="padding:3px;border-radious:0px;" href="{{ route('restaurants.index') }}"> Back to Restaurants</a></span></p>
                
            </div>
            
        </div>     
    @else
        @foreach($items as $item)
            <div class="d-flex bd-highlight mb-5 mt-5 single-item-wrap">
                <div class="p-2 bd-highlight flex-shrink-0">
                    <img src="{{ url($item->associatedModel->product_image) }}" width="80" class="rounded-2" alt="{{ $item->associatedModel->slug}}">
                </div>
                <div class="p-2 bd-highlight">
                    <h6>{{ $item->name }}</h6>
                    
                    <input type="hidden" wire:model="quantity.{{ $item->id }}">
                    
                    <p>{{ Illuminate\Support\Str::limit($item->associatedModel->description, 15) }}</p>
                    <h6 style="font-weight:500;" class="price">₦{{ $item->price }} 
                        <small class="p-1 rounded-2 alert-success"> x {{ $item->quantity }} <span> = {{ $item->getPriceSum() }}</span></small>
                    </h6>
                    
                </div>
                <div class="ms-auto p-2 bd-highlight btn-group-vertical">
                    <button wire:click.prevent="updateQuantity({{ $item->id }})" class="btn btn-sm back-page-btn">+</button>
                    <button wire:click.prevent="reduceQuantity({{ $item->id }})" class="btn btn-sm back-page-btn">-</button>
                </div>
            </div>     
        @endforeach
    @endif
</div>
<div class="order-cart-area d-block">
    <form class="order-cart">
        <ul>
            <li>Subtotal<span>₦{{ $cart->getSubTotal() }}</span></li>
            <li>Delivery Fee<span>{{ $cart->isEmpty()? '₦0.00': '₦'.$cart->vendor()->delivery_fee }}</span></li>
            <li>
                <div class="single-input-wrap with-btn">
                    <input type="text" class="form-control" placeholder="Apply your coupons">
                    <button class="btn">Apply</button>
                </div>
            </li>
            <li class="total">Total<span>₦{{ $cart->isEmpty()? '0.00': number_format(str_replace(',','', $cart->getSubTotal()) + $cart->vendor()->delivery_fee,2)}}</span></li>
        </ul>
        <a style="font-size:18px;" class="btn btn-white w-100" href="{{ url()->current() == route('order.cart') ? route('user.checkout') : route('order.cart') }}"> {{ $cart->isEmpty() ? 'ORDER  FOR ₦0.00' : strtoupper('order '.$cart->getContent()->count().' for ₦'. number_format(str_replace(',','', $cart->getSubTotal()) + $cart->vendor()->delivery_fee,2))}}</a>
    </form>
</div>