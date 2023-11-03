<div wire:ignore.self class="modal fade modal-fullscreen filter-modal-popup" id="cartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container">
                <div class="modal-header">
                    <h5 class="modal-title">My Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
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
            </div>
            <div class="order-cart-area">
                <form class="order-cart">
                    <ul>
                        <li>Subtotal<span>₦{{   $cart->getSubTotal() }}</span></li>
                        <li>Delivery Fee<span>₦750.00</span></li>
                        <li>
                            <div class="single-input-wrap with-btn">
                                <input type="text" class="form-control" placeholder="Apply your couons">
                                <button class="btn">Apply</button>
                            </div>
                        </li>
                        <li class="total">Total<span>₦{{   $cart->getTotal() }}</span></li>
                    </ul>
                    <a class="btn btn-white w-100" href="#"> Checkout</a>
                </form>
            </div>
        </div>
    </div>
</div>

 
    


