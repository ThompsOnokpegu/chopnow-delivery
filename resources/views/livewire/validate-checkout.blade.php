<form wire:submit="placeOrder">
    <div class="container">
        <div class="cardd">
            <a class="btn back-page-btn mt-3" href="{{ route('order.cart') }}"><i class="ri-arrow-left-s-line"></i></a>
            <div class="row">
                <div class="col-md-8 mb-4">
                  <div class=" mb-4">
                    @if(session()->has('message'))
                      <div class="alert alert-info">
                        {{ session('message') }}
                      </div>
                    @endif
                    <h4 class="mt-3">Your Order</h4>
                    <h2 style="font-weight:bold;">{{ $vendor->business_name }}</h2>
                    <div class="single-page-details mt-5">
                        <label>{{ $cart->getContent()->count()}} {{ $cart->getContent()->count() == 1 ? 'product': 'products'; }} from <strong>{{ $vendor->business_name }}</strong></label>
                         
                        @foreach($cart->getContent() as $item)
                            <div class="d-flex bd-highlight"> 
                                <div class="p-2 bd-highlight">
                                    <p style="font-weight:500;">
                                        <span class="p-1 rounded-2 alert-warning"> {{ $item->quantity }} x</span>
                                        <a href="#">{{ $item->name }}</a> 
                                    </p>                                
                                </div>
                                <div class="ms-auto p-2 bd-highlight btn-group-vertical">
                                    <h6 style="font-weight:500;" class="price">₦{{ number_format($item->price,2)}} 
                                </div>  
                            </div>     
                        @endforeach
    
                        <div class="payment-wrap mt-5">
                             
                            @csrf()
                            
                            <input type="hidden" wire:model="email">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="text-uppercase accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                      <h6>Delivery Details</h6>
                                    </button>
                                  </h2>
                                  <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <p>{{ Auth::user()->name }}</p>
                                        <p>{{ session('delivery_address') }}</p>
                                        <p>{{ session('phone') }}</p>
                                        @if(!session('phone') || !session('delivery_address'))
                                          <a href="{{ route('user.address') }}"><strong class="alert alert-info">Enter missing details</strong></a>
                                        @endif
                                        
                                    </div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                      {{ $alternate_name != null ? 'Order will be sent to '.$alternate_name : 'Send To A Friend' }}
                                    </button>
                                  </h2>
                                  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        @if (session()->has('message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                          {{ session('message') }} 
                                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                          
                                        @endif
                                        <p>Add their details to help the courier</p>
                                        <div class="container">
                                          
                                            <label>Add a Name<small class="error">*</small></label>
                                            <div class="single-input-wrap style-2">
                                                <input type="text" wire:model="alternate_name" class="form-control">
                                                @error('name')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <label>Contact Phone<small class="error">*</small></label>
                                            <div class="single-input-wrap style-2">
                                                <input type="text" wire:model="alternate_phone" class="form-control">
                                                @error('phone')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <label>Delivery Address<small class="error">*</small></label>
                                            <div class="single-input-wrap style-2">
                                                <input type="text" wire:model="alternate_address" class="form-control">
                                                @error('address')
                                                    <div class="error">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <label>Floor, Flat, Instruction<small> (optional)</small></label>
                                            <div class="single-input-wrap style-2">
                                                <input type="text" wire:model="address2" class="form-control">
                                            </div>
                                            <button wire:click ="setDeliveryDetails()" class="btn btn-base w-100">Add Details</a>
                                        </div>
                                    </div>
                                  </div>
                                </div>
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
                          <span>₦{{ $vendor->delivery_fee }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Services
                            <span>₦{{ $fees }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                          <div>
                            <strong>Total amount</strong>
                          </div>
                          <span><strong>₦{{ number_format((int)str_replace(',','', $this->cart->getTotal()) + (int)$fees,2) }}</strong></span>
                        </li>
                      </ul>
                      <div class="payment-wrap">
                        @error('payment_method')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        <ul class="payment-check">
                            <li>
                                <div class="form-check">
                                    <input wire:model="payment_method" class="form-check-input" value="COD" type="radio" name="flexRadioDefault" id="payment1">
                                    <label class="form-check-label" for="payment1">
                                    </label>
                                    Cash on Delivery
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input wire:model="payment_method" class="form-check-input" value="Paystack" type="radio" name="flexRadioDefault" id="payment2">
                                    <label class="form-check-label" for="payment2">
                                    </label>
                                    Credit or Debit Card
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
                                <a href="#"><img src="{{ asset('customer/assets/img/icon/card/4.jpeg') }}" alt="img"></a>
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
