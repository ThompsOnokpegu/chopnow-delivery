@extends('frontend.restaurant.layouts.main')


@section('content')
<div class="single-banner-area" style="background-image: url({{ url(env('CLOUD_BASE_URL').$order->vendor->kitchen_banner_image) }});">
    <div class="container" style="position: relative;">
        <a class="btn back-page-btn" href="{{ route('user.chops') }}"><i class="ri-arrow-left-s-line"></i></a>
        <div class="restuarent-details">
            <div class="media">
                {{-- <div class="thumb">
                    <img src="{{ asset('vendor/assets/img/brands/'.$vendor->kitchen_banner_image) }}" width="70" style="background-color: #fff;" class="rounded-2" alt="img">
                    <span>Open</span>
                </div> --}}
                <div class="media-body">
                    <h3>{{ $order->vendor->business_name }}</h3>
                    {{-- <p>{{ $vendor->address }}</p> --}}
                </div>
            </div>
           
        </div>
    </div>
</div>

<div class="container">
    <div class="cardd">
        {{-- <a class="btn back-page-btn mt-3" href="{{ route('order.cart') }}"><i class="ri-arrow-left-s-line"></i></a> --}}
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="d-flex bd-highlight mb-5 mt-3">
                    <div class="p-2 bd-highlight flex-shrink-0">
                        <img src="{{ asset('customer/delivery.png') }}" width="50" alt="delivery-status">
                    </div>
                    <div class="p-2 bd-highlight">
                        <h6 class="mb-0">Chop ID #{{$order->id.': '.$order->order_status }}</h6>    
                        <span style="font-weight:400;" class="price">{{ \Carbon\Carbon::parse($order->created_at)->format('j F, Y')}}</span>
                        <p class="mb-0"><small>{{ $order->created_at->diffForHumans() }}</small></p>    
                    </div>            
                </div>    
            </div>
            <div class="col-md-12 mb-4">
              <div class=" mb-4">
                <h6>Your Chops</h6>
                <label class="mb-3">{{ $items->count()}} {{ $items->count() == 1 ? 'product': 'products'; }} from <strong>{{ $order->vendor->business_name }}</strong></label>
                 
                @foreach($items as $item)
                    <div class="d-flex bd-highlight"> 
                        <div class="bd-highlight">
                            <p style="font-weight:500;">
                                <span class="p-1 rounded-2 alert-warning"> {{ $item->quantity }} x</span>
                                <a href="#">{{ $item->name }}</a> 
                            </p>                                
                        </div>
                        <div class="ms-auto bd-highlight btn-group-vertical">
                            <h6 style="font-weight:500;" class="price">₦{{ $item->price }} 
                        </div>  
                    </div>     
                @endforeach

                <div class="payment-wrap mt-5">
                    <h6>Delivery Details</h6>                   
                    <div class="accordion-body">
                        <p><i style="color:#ffc244;" class="ri-phone-line"> </i>{{ $order->recipient_phone }}</p>                                   
                        <p><i style="color:#ffc244;" class="ri-map-pin-line"> </i>{{ $order->recipient_address }}</p>                                   
                    </div>
                    
                </div>
              </div>
            </div>
          
            <div class="col-md-12 mb-5">
              <div class="mb-5" style="border-radius:10px; border:0px;">
                <div class="mb-5">
                    <h6>Sumary</h6>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                      Products
                      <span>₦{{ number_format($order->total - $order->shipping, 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                      Delivery
                      <span>₦{{ $order->shipping }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        Services
                        <span>₦0.00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-1">
                      <div>
                        <strong>Total amount</strong>
                      </div>
                      <span><strong>₦{{ $order->total }}</strong></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        @if($order->payment_method == "COD")
                            <small><i class="ri-wallet-line"></i> Paid with cash   </small>
                        @else 
                            <small><i class="ri-bank-card-line"></i> Paid online   </small>
                        @endif
                    </li>
                  </ul>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>


@endsection