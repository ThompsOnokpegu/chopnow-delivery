@extends('frontend.checkout.layouts.main')

@section('content')
<form action="{{ route('order.checkout') }}" method="POST">
<div class="container">
    <div class="cardd">
        <a class="btn back-page-btn mt-3" href="{{ route('order.cart') }}"><i class="ri-arrow-left-s-line"></i></a>
        <div class="row">
            <div class="col-md-8 mb-4">
              <div class=" mb-4">
                <h4 class="mt-3">Your Order</h4>
                <h2 style="font-weight:bold;">{{ $vendor->business_name }}</h2>
                <div class="single-page-details mt-5">
                    <label>{{ $cart->getContent()->count() }} products from <strong>{{ $vendor->business_name }}</strong></label>
                    
                    @foreach($cart->getContent() as $item)
                        <div class="d-flex bd-highlight"> 
                            <div class="p-2 bd-highlight">
                                <p style="font-weight:500;">
                                    <span class="p-1 rounded-2 alert-success"> {{ $item->quantity }} x</span>
                                    <a href="#">{{ $item->name }}</a> 
                                </p>                                
                            </div>
                            <div class="ms-auto p-2 bd-highlight btn-group-vertical">
                                <h6 style="font-weight:500;" class="price">₦{{ $item->price }} 
                            </div>  
                        </div>     
                    @endforeach

                    <div class="payment-wrap mt-5">
                        
                            @csrf()
                            <h4>Delivery Details</h4>
                            <p class="text-uppercase fw-bold mb-3 text-font">Email address</p>
                            <p>{{ Auth::user()->email }}</p>
                            <input type="hidden" name="email" value="tommy@gmail.com">
                            <label>Add a Name</label>
                            <div class=" style-2">
                                <input type="text" name="name" class="form-control" style="border-top:0px;border-right:0px;border-left:0px;border-bottom:1px solid #999;">
                            </div>
                            <label>Contact Phone</label>
                            <div class=" style-2">
                                <input type="text" name="phone" class="form-control" style="border-top:0px;border-right:0px;border-left:0px;border-bottom:1px solid #999;">
                            </div>
                            <label>Delivery Address</label>
                            <div class="style-2">
                                <input type="text" name="address1" class="form-control" style="border-top:0px;border-right:0px;border-left:0px;border-bottom:1px solid #999;">
                            </div>
                            <label>Floor, Flat, Instruction</label>
                            <div class="single-input-wra style-2">
                                <input type="text" name="address2" class="form-control" style="border-top:0px;border-right:0px;border-left:0px;border-bottom:1px solid #999;">
                            </div>
                        
                    </div>
                </div>
              </div>
            </div>
          
            <div class="col-md-4 mb-4 mt-4">
              <div class="card mb-4 shadow" style="border-radius:10px; border:0px;">
                <div class="card-body">
                    <h4>Sumary</h4>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                      Products
                      <span>₦{{ $cart->getSubTotal() }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                      Shipping
                      <span>₦750.00</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        VAT (7.5%)
                        <span>0.0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                      <div>
                        <strong>Total amount</strong>
                      </div>
                      <span><strong>₦{{ $cart->getTotal() }}</strong></span>
                    </li>
                  </ul>
                  <div class="payment-wrap">
                    <ul class="payment-check">
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                </label>
                                Cash on delivery
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                </label>
                                Credit or Debit card
                            </div>
                        </li>
                    </ul>
                    <ul class="payment-card">
                        <li>
                            <a href="#"><img src="{{ asset('customer/assets/img/icon/card/1.png') }}" alt="img"></a>
                        </li>
                        <li>
                            <a href="#"><img src="{{ asset('customer/assets/img/icon/card/2.png') }}" alt="img"></a>
                        </li>
                        <li>
                            <a href="#"><img src="{{ asset('customer/assets/img/icon/card/3.png') }}" alt="img"></a>
                        </li>
                        <li>
                            <a href="#"><img src="{{ asset('customer/assets/img/icon/card/4.png') }}" alt="img"></a>
                        </li>
                    </ul>
                    
                    <button type="submit" class="btn btn-base w-100">Place Order</a>
                </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
</form>  
@endsection