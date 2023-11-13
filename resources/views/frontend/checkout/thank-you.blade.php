@extends('frontend.checkout.layouts.main')


@section('content')
<div class="container">
    <div class="align-items-center d-flex justify-content-center vh-90">
        <div class="successful-msg-page  btn-bottom-fixed text-center">
            <img src="{{ asset('customer/assets/img/icon/check.png') }}" alt="img">
            <h3>Order Placed Successfully!</h3>
            <p>Congratulations, You have successfully placed your order.</p>
            <h5>Order Number: #{{ $order }}</h5>
            <small>Reference: {{ $reference }}</small>    
            <div class="btn-fixed-wrap">
                <a class="btn btn-base w-100" href="{{ route('restaurants.index') }}">Return</a> 
            </div>          
        </div>           
    </div>
</div> 
@endsection

{{-- @extends('vendor.layouts.user')


@section('content')
<div class="col-xl-6 mb-4 mb-xl-0">
    <div class="card">
      <h5 class="card-header">Order Number: #{{ $order }}</h5>
      <div class="card-body">
        <ul class="timeline">
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-indicator-advanced timeline-indicator-info">
              <i class="bx bx-user-circle"></i>
            </span>
            <div class="timeline-event">
              <div class="timeline-header mb-3">
                <h6 class="mb-0">Order Placed</h6>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-indicator-advanced timeline-indicator-info">
              <i class="bx bx-user-circle"></i>
            </span>
            <div class="timeline-event">
              <div class="timeline-header mb-sm-0 mb-3">
                <h6 class="mb-0">Processing</h6>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-indicator-advanced timeline-indicator-info">
              <i class="bx bx-user-circle"></i>
            </span>
            <div class="timeline-event">
              <div class="d-flex flex-sm-row flex-column">
                <div>
                  <div class="timeline-header flex-wrap mb-2 mt-3 mt-sm-0">
                    <h6 class="mb-0">Enroute</h6>
                  </div>
              </div>
            </div>
          </li>
          <li class="timeline-item timeline-item-transparent">
            <span class="timeline-indicator-advanced timeline-indicator-info">
              <i class="bx bx-user-circle"></i>
            </span>
            <div class="timeline-event">
              <div class="d-flex flex-sm-row flex-column">
                <div>
                  <div class="timeline-header flex-wrap mb-2 mt-3 mt-sm-0">
                    <h6 class="mb-0">Delivered</h6>
                  </div>
              </div>
            </div>
          </li>
          <li class="timeline-end-indicator">
            <i class="bx bx-check-circle" style="color:#71dd37;"></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection --}}