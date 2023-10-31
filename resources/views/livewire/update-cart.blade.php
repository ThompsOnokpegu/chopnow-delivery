<div class="product-details-area mt-4">
    <div class="product-details-wrap text-center">
        <img src="{{ asset('product-images/'.$image) }}" class="rounded-2" alt="img">
        <h5 class="mt-2">{{ $name }}</h5>
    </div>
    <div class="wrap-details">
        <p>{{ $description }}</p>
    </div>
    
    {{-- <div class="wrap-details">
        <h6>Special instructions</h6>
        <p>Please let us know if you are allergic to anything or if we need to avoid anything.</p>
    </div>
    <div class="single-textarea-wrap">
        <textarea rows="4" placeholder="e.g. no mayo"></textarea>
    </div> --}}
    <div class="product-size text-center" >
        <form class="mt-5 mb-4">
            <div class="quantity buttons_added mb-3 text-center">
                <input wire:click="decrement" type="button" value="-" class="minus" style="color:black;">
                <input wire:model="quantity" type="number" class="input-text qty text" style="color:black;">
                <input wire:click="increment" type="button" value="+" class="plus" style="color:black;">
            </div>
            
        </form>
    </div>
    <button wire:click.prevent="updateQuantity" class="btn btn-base w-100"><i class="ri-shopping-cart-line"></i>
        <span>Add {{ $quantity }} for ₦{{ $price * $quantity }}</span>   
    </button>
</div>