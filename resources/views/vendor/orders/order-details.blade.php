@extends('vendor.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 order-0"> 
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('orders.index') }}" >Orders</a></span>/ Details</h4>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

              <div class="d-flex flex-column justify-content-center">
                <h5 class="mb-1 mt-3">Order #{{ $order->id }}</h5>
                <p class="text-body">{{ $order->created_at->toDayDateTimeString() }} (GMT)</p>
              </div>
              <div class="d-flex align-content-center flex-wrap gap-2">
                {{-- right --}}
              </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="table-responsive text-nowrap">
                        <table class="table card-table">
                          <thead>
                            <tr>
                              <th>PRODUCT</th>
                              <th>PRICE</th>
                              <th>QUANTIY</th>
                              <th>TOTAL</th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            @include('vendor.orders._order-items')
                          </tbody>
                        </table>
                    </div>
                    <div class="mb-4">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="card-header">
                            <h5 class="card-title mb-3"><strong>Delivery Details</strong></h5>
                            <div class="card-body">
                              {{-- <div class="d-flex justify-content-start align-items-center mb-4">
                                <div class="d-flex flex-column">
                                  <a href="app-user-view-account.html" class="text-body text-nowrap">
                                    <h6 class="mb-0">{{ $order->user->name }}</h6>
                                  </a>
                                  <small class="text-muted">Customer ID: {{ $order->user->id }}</small>
                                </div>
                              </div> --}}
                              <p class=" mb-1">{{ $order->recipient_name }}</p>
                              <p class="mb-2">{{ $order->recipient_address }}</p>
                              <p class=" mb-0">{{ $order->recipient_phone }}</p>
                            </div>
                          </div>
                          
                        </div>
                        {{-- <div class="col-lg-6">
                          <div class="card-header">
                            <h5 class="card-title mb-3"><strong> Delivery Address</strong></h5>
                            <div class="card-body">
                              <p class="mb-2">{{ $order->recipient_address }}</p>
                            </div>
                          </div>
                        </div> --}}
                      </div>
                    </div> 
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">SUMMARY</h5>
                        </div>
                        <div class="card-body">
                            <li class="d-flex mb-2 pb-1">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">Items Subtotal:</h6>
                                  </div>
                                  <div class="user-progress d-flex align-items-center gap-1">
                                    <span class="text-muted">₦</span>
                                    <h6 class="mb-0">{{ number_format($subtotal,2) }}</h6>
                                  </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">Discount:</h6>
                                  </div>
                                  <div class="user-progress d-flex align-items-center gap-1">
                                    <span class="text-muted">₦</span>
                                    <h6 class="mb-0">{{ number_format($order->discount,2) }}</h6>
                                  </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">Fees:</h6>
                                  </div>
                                  <div class="user-progress d-flex align-items-center gap-1">
                                    <span class="text-muted">-₦</span>
                                    <h6 class="mb-0" style="color:red;">{{ number_format($order->fees,2) }}</h6>
                                  </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">Subtotal:</h6>
                                  </div>
                                  <div class="user-progress d-flex align-items-center gap-1">
                                    <span class="text-muted">₦</span>
                                    <h6 class="mb-0">{{ number_format($subtotal - $order->discount -$order->fees,2) }}</h6>
                                  </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">Shippping:</h6>
                                  </div>
                                  <div class="user-progress d-flex align-items-center gap-1">
                                    <span class="text-muted">₦</span>
                                    <h6 class="mb-0">{{ number_format($order->shipping,2) }}</h6>
                                  </div>
                                </div>
                            </li>
                            <hr>
                            <li class="d-flex mb-2 pb-1">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h4 class="mb-0">Total:</h4>
                                  </div>
                                  <div class="user-progress d-flex align-items-center gap-1">
                                    <h4 class="mb-0">{{ '₦'.number_format(($subtotal - $order->discount - $order->fees) + $order->shipping,2) }}</h4>
                                  </div>
                                </div>
                            </li>
                        </div>
                    </div>
                    @livewire('update-order-status', ['order' => $order])
                </div>
            </div>
            
            <div class="card-body">
              
            </div>
                 
        </div>
    </div>
</div>
@endsection