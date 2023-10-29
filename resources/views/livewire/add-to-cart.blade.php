<div class="product-siz text-center mb-5">
    <form class="mt-5 mb-4">
        {{-- <input type="hidden" wire:model="menu_id" value="{{ $menu_id }}"> --}}
        <div class="quantity buttons_added mb-3">
            <input wire:click="decrement" type="button" value="-" class="minus">
            <input wire:model="quantity" type="number" class="input-text qty text" value="1">
            <input wire:click="increment" type="button" value="+" class="plus">
        </div>
        <button wire:click.prevent="addProduct" class="btn btn-base text-center" href="#"><i class="ri-shopping-cart-line"></i>
            <span>Add {{ $quantity }} for ₦{{ $menu->regular_price * $quantity }}</span>
            
        </button>
    </form>
    {{-- <div class="sent-to-cart-btn">
        <div class="media-left">
            <span>Add {{ $quantity }} for</span>
            <h5>₦{{ $menu->regular_price * $quantity }}</h5>
        </div>
        <a href="#"><img src="{{ asset('customer/assets/img/icon/svg/bag.svg') }}" alt="img"></a>
    </div> --}}
</div>