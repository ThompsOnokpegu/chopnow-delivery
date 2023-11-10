<div class="container">
    <div class="modal-header">
        <h5 class="modal-title">Basket</h5>
    </div>
    @if ($cart->isEmpty())
        <div class="d-flex bd-highlight mb-3 mt-3 ">
            <div class="p-5 bd-highlight flex-shrink-0 text-center">
                <p class="">Your cart is empty! <span><a class="btn-white w-100" style="padding:3px;border-radious:0px;" href="{{ route('restaurants.index') }}"> Back to Restaurants</a></span></p>
                
            </div>
        </div>     
    @else
        @foreach($items as $item)
            <div class="d-flex bd-highlight mb-3 mt-3 single-item-wrap">
                <div class="p-2 bd-highlight flex-shrink-0">
                    <img src="{{ asset('product-images/main-dish.png') }}" width="80" class="rounded-2" alt="">
                </div>
                <div class="p-2 bd-highlight">
                    <h6><a href="{{ route('restaurants.product',$item->id)}}">{{ $item->name }}</a></h6>
                    
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
        <div class="mb-2 mt-2">
            <div class="p-2 flex-shrink-0 text-center">
                <p class="text-center"><span><a class="btn-white w-100" style="padding:10px;border-radius:5px;" href="{{ route('restaurants.index') }}"> Continue Shopping</a></span></p>    
            </div>
        </div>  
    @endif
</div>
<div class="order-cart-area d-block">
    <form class="order-cart">
        <ul>
            <li>Subtotal<span>₦{{   $cart->getSubTotal() }}</span></li>
            <li>Delivery Fee<span>{{ $cart->isEmpty()? '₦0.00':'₦750.00' }}</span></li>
            <li>
                <div class="single-input-wrap with-btn">
                    <input type="text" class="form-control" placeholder="Apply your couons">
                    <button class="btn">Apply</button>
                </div>
            </li>
            <li class="total">Total<span>₦{{ $cart->isEmpty()? '0.00': $cart->getTotal()    }}</span></li>
        </ul>
        <a class="btn btn-white w-100" href="{{ route('user.checkout') }}"> CHECKOUT</a>
    </form>
</div>