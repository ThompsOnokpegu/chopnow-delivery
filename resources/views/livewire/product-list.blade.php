<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        @foreach ($products as $product) 
        <form>
            <div class="d-flex bd-highlight mb-3 single-item-wrap">
                <div class="p-2 bd-highlight flex-shrink-0">
                    <img src="{{ asset('storage/menu-images/'.$product->product_image) }}" width="80" class="rounded-2" alt="{{ $product->slug}}">
                </div>
                <div class="p-2 bd-highlight">
                    <h6><a href="{{ route('restaurants.product',$product->id)}}">{{ $product->name }}</a></h6>
                    <p>{{ Illuminate\Support\Str::limit($product->description, 45) }}</p>
                    <h6 style="font-weight:500;" class="price">₦{{ $product->regular_price }} 
                        @if(isset($cart[$product->id]))
                            <small class="p-1 rounded-2 alert-success"> x {{ $cart[$product->id]['quantity'] }}</small>
                        @endif
                    </h6>
                    
                </div>
                <div class="ms-auto p-2 bd-highlight btn-group-vertical">
                    <button wire:click.prevent="addToCart({{ $product->id }})" class="btn btn-sm back-page-btn">+</button>
                    @if(isset($cart[$product->id]))
                        <button wire:click.prevent="reduceQuantity({{ $product->id }})" class="btn btn-sm back-page-btn">-</button>
                    @endif
                </div>
            </div>    
        </form>
                                           
        @endforeach
    </div>
</div>
