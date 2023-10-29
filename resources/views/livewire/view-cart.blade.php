<div>
    <div class="container">
        <div class="cart-page-area">
            <a class="btn back-page-btn" href="main-home.html"><i class="ri-arrow-left-s-line"></i></a>
            <h6 class="page-title text-center">My Cart</h6>
            @if ($cartItems->isEmpty())
                <p class="text-center">Your cart is empty.</p>
            @else
                @foreach ($cartItems as $item)
                    <div class="cart-product-wrap">
                        {{-- <div class="thumb">
                            <img src="{{ asset('customer/assets/img/item/cart-1.png') }}" alt="img">
                        </div> --}}
                        <div class="media-body">
                            <h6>{{ $item->menu->name }}</h6>
                            <p><span>₦{{ $item->menu->regular_price }}</span><i class="ri-checkbox-blank-circle-fill"></i> x {{ $item->quantity }}</p>
                        </div>
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" href="{{ route('cart.edit', $item->id) }}">
                            Edit
                        </button>
                     
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="order-cart-area">
        <form class="order-cart">
            <ul>
                <li>Subtotal<span>₦6,800.00</span></li>
                <li>Delivery Fee<span>₦750.00</span></li>
                <li>
                    <div class="single-input-wrap with-btn">
                        <input type="text" class="form-control" placeholder="Apply your couons">
                        <button class="btn">Apply</button>
                    </div>
                </li>
                <li class="total">Total<span>₦7,550.00</span></li>
            </ul>
            <a class="btn btn-white w-100" href="#"> Checkout</a>
        </form>
    </div>
</div>

 
    


