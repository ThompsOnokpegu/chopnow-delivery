
@extends('restaurant.layouts.main')

@section('content')
    @livewire('view-cart')
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
                        <a class="btn btn-base w-100" href="{{ route('restaurants.cart') }}">Done</a>
                    </div>
                    
                </div>              
            </div>
        </div>
    </div>
@endsection
