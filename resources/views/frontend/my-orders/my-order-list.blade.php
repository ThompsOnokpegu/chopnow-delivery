@extends('frontend.checkout.layouts.main')

@section('content')
<div class="container">
    <div class="modal-header" style="border-bottom:0px;">
       
        <h5 class="modal-title"> <a class="btn back-page-btn mb-3" href="{{ route('user.account') }}"><i class="ri-arrow-left-s-line"></i></a> My Chops</h5>
    </div>
    @forelse($orders as $order)
        <div class="d-flex bd-highlight mb-3 mt-3 single-item-wrap">
            <div class="p-2 bd-highlight flex-shrink-0">
                <img src="{{ url(env('CLOUD_BASE_URL').$order->vendor->kitchen_banner_image) }}" width="150" class="rounded-2" alt="restaurant-image">
            </div>
            <div class="p-2 bd-highlight">
                <h6 class="mb-0"><a href="{{ route('chop.details',$order->id)}}">{{ $order->vendor->business_name }}</a></h6>    
                <span style="font-weight:400;" class="price">₦{{ $order->total }}</span>
                <p class="mb-0"><small>{{ $order->created_at->diffForHumans() }}</small></p>    
            </div>            
        </div>
    @empty
        <div class="d-flex bd-highlight mb-3 mt-3 single-item-wrap">
            No chops yet!
        </div>
    @endforelse
</div>
@endsection
