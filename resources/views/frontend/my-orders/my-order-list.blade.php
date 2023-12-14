@extends('frontend.checkout.layouts.main')

@section('content')
<div class="container">
    <div class="modal-header" style="border-bottom:0px;">
       
        <h5 class="modal-title"> <a class="btn back-page-btn mb-3" href="{{ route('user.account') }}"><i class="ri-arrow-left-s-line"></i></a> My Choppings</h5>
    </div>
    @forelse($orders as $order)
    <a href="{{ route('chop.details',$order->id)}}">
        <div class="d-flex bd-highlight mb-3 mt-3 single-item-wrap">
            <div class="bd-highlight flex-shrink-0">
                <img src="{{ url(env('CLOUD_BASE_URL').$order->vendor->kitchen_banner_image) }}" width="150" class="rounded-2" alt="restaurant-image">
            </div>
            <div class="p-2 bd-highlight">
                <p style="font-size:0.9rem;font-weight:700;"class="mb-0">{{ $order->vendor->business_name }}</p>    
                <span style="font-size:0.9rem;font-weight:400;" class="price">₦{{ $order->total }}</span>
                <p class="mb-0"><small>{{ $order->created_at->diffForHumans() }}</small></p>    
            </div> 
            <div class="bd-highlight ms-auto">
               <small style="font-size:0.8rem;">{{ $order->order_status }}</small>
            </div>
        </div>
    </a>
    @empty
        <div class="d-flex bd-highlight mb-3 mt-3 single-item-wrap">
            No choppings yet!
        </div>
    @endforelse
</div>
@endsection
