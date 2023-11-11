@extends('vendor.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 order-0"> 
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orders/</span> All</h4>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">

              <div class="d-flex flex-column justify-content-center">
                <h5 class="mb-1 mt-3">Order #{{ $order->id }} <span class="badge bg-label-success me-2 ms-2">{{ $order->order_status }}</span></h5>
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
                            <h5 class="card-title mb-3"><strong> Customer</strong></h5>
                            <div class="card-body">
                              <div class="d-flex justify-content-start align-items-center mb-4">
                                <div class="d-flex flex-column">
                                  <a href="app-user-view-account.html" class="text-body text-nowrap">
                                    <h6 class="mb-0">{{ $order->user->name }}</h6>
                                  </a>
                                  <small class="text-muted">Customer ID: {{ $order->user->id }}</small>
                                </div>
                              </div>
                              
                              <div class="d-flex justify-content-between">
                                <h6>Delivery Contact</h6>
                                
                              </div>
                              <p class=" mb-1">Name: {{ $order->recipient_name }}</p>
                              <p class=" mb-1">Email: {{ $order->user->email }}</p>
                              <p class=" mb-0">Mobile: {{ $order->recipient_phone }}</p>
                            </div>
                          </div>
                          
                        </div>
                        <div class="col-lg-6">
                          <div class="card-header">
                            <h5 class="card-title mb-3"><strong> Delivery Address</strong></h5>
                            <div class="card-body">
                              <p class="mb-2">{{ $order->recipient_address }}</p>
                            </div>
                          </div>
                        </div>
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
                                    <h6 class="mb-0">{{ $subtotal }}.00</h6>
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
                                    <h6 class="mb-0">{{ $order->discount }}</h6>
                                  </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 pb-1">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                  <div class="me-2">
                                    <h6 class="mb-0">Tax:</h6>
                                  </div>
                                  <div class="user-progress d-flex align-items-center gap-1">
                                    <span class="text-muted">₦</span>
                                    <h6 class="mb-0">0.00</h6>
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
                                    <h6 class="mb-0">{{ ($subtotal - $order->discount) }}.00</h6>
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
                                    <h6 class="mb-0">{{ $order->shipping }}</h6>
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
                                    <span class="text-muted">₦</span>
                                    <h4 class="mb-0">{{ ($subtotal - $order->discount) + $order->shipping }}.00</h4>
                                  </div>
                                </div>
                            </li>
                        </div>
                    </div>
                    <div class="card mb-4">
                      <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">ORDER STATUS</h5>
                      </div>
                      <form action="{{ route('order.status',$order->id) }}" method="POST">
                        @csrf
                        <div class="card-body">
                          <div class="d-flex justify-content-between row py-3 gap-3 gap-md-0">
                            <div class="col-md-12 product_status">
                              <select id="OrderStatus" name="order_status" class="form-select text-capitalize">
                                <option value="">Status</option>
                                <option value="Awaiting Payment" @selected('Awaiting Payment'==old('order_status',$order->order_status))>Awaiting Payment</option>
                                <option value="Processing" @selected('Processing'==old('order_status',$order->order_status))>Processing</option>
                                <option value="Enroute" @selected('Enroute'==old('order_status',$order->order_status))>Enroute</option>
                                <option value="Delivered" @selected('Delivered'==old('order_status',$order->order_status))>Delivered</option>
                                <option value="Canceled" @selected('Canceled'==old('order_status',$order->order_status))>Canceled</option>
                              </select>
                            </div>
                            <div class="d-flex align-content-center flex-wrap mt-4">
                              <button type="submit" class="btn btn-md btn-primary">Update</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
              
            </div>
                 
        </div>
    </div>
</div>
@endsection