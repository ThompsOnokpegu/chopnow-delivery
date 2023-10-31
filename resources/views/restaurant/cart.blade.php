
@extends('restaurant.layouts.main')

@section('content')
<div>
    <div class="container">
        <div class="cart-page-area">
            <a class="btn back-page-btn" href="main-home.html"><i class="ri-arrow-left-s-line"></i></a>
            <h6 class="page-title text-center">My Cart</h6>
            @if ($cartItems->isEmpty())
                <p class="text-center">Your cart is empty.</p>
            @else
                    @php 
                        $subtotal = 0;      
                    @endphp
                @foreach ($cartItems as $item)
                    <div class="cart-product-wrap">
                        {{-- <div class="thumb">
                            <img src="{{ asset('customer/assets/img/item/cart-1.png') }}" alt="img">
                        </div> --}}
                        <div class="media-body">
                            <h6><strong style="weight:600; color:black;" >{{ $item->quantity }} x </strong> {{ $item->menu->name }} </h6>
                            <p><span>₦{{ $item->menu->regular_price * $item->quantity }}</span> <span> <i wire:click="removeItem" style="font-size:14px; color:red;" class="ri-delete-bin-line"></i></span></p>    
                        </div>

                        <button data-bs-toggle="modal" data-bs-target="{{ '#'.str()->slug($item->menu->name) }}">
                            Edit
                        </button>
                     
                    </div>
                    <!-- Modal -->
                    <div class="modal fade filter-modal-popup" id="{{ str()->slug($item->menu->name) }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="container">    
                                    @livewire('update-cart', ['cartItemId' => $item->id])
                                </div>              
                            </div>
                        </div>
                    </div>
                    @php     
                        $subtotal += $item->menu->regular_price * $item->menu->quantity;
                    @endphp
                @endforeach
            @endif
        </div>
    </div>
    <div class="order-cart-area">
        <form class="order-cart">
            <ul>
                <li>Subtotal<span>{{ $subtotal }}
                </span></li>
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
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade filter-modal-popup" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <div class="product-details-area mt-4">
                        <div class="product-details-wrap text-center">
                            <h5>Double Cheese Pan</h5>
                            <p>Mixed Pizza with Cheese</p>
                            <img src="{{ asset('customer/assets/img/item/single-product.png') }}" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h6>Product details</h6>
                            <p>The Original Pan pizza and the iconic Stuffed Crust pizza. A layer of toasted parmesan is baked into the crust of the Original Pan pizza.</p>
                        </div>
                        <div class="product-size">
                            <ul class="size">
                                <li><a href="#">S</a></li>
                                <li><a href="#">M</a></li>
                                <li><a href="#">L</a></li>
                            </ul>
                            <form>
                                <div class="quantity buttons_added" >
                                    <input type="button" value="-" class="minus" style="color:red;">
                                    <input type="number" class="input-text qty text" step="1" min="1" max="10000" name="quantity" value="1" style="color:black;">
                                    <input type="button" value="+" class="plus" style="color:green;">
                                </div>
                            </form>
                        </div>
                        <div class="wrap-details">
                            <h6>Special instructions</h6>
                            <p>Please let us know if you are allergic to anything or if we need to avoid anything.</p>
                        </div>
                        <div class="single-textarea-wrap">
                            <textarea rows="4" placeholder="e.g. no mayo"></textarea>
                        </div>
                        <a class="btn btn-base w-100" href="{{ route('user.cart') }}">Done</a>
                    </div>
                    
                </div>              
            </div>
        </div>
    </div>
@endsection
