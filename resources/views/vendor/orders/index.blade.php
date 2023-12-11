@extends('vendor.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 order-0"> 
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orders/</span> All</h4>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive text-nowrap">
                            <table class="table card-table">
                              <thead>
                                <tr>
                                  <th>ORDER</th>
                                  <th>TOTAL</th>
                                  <th>FEES</th>
                                  <th>STATUS</th>
                                  <th>PAYMENT CHANNEL</th>
                                  <th>CUSTOMER</th>
                                  <th>DATE</th>
                                </tr>
                              </thead>
                              <tbody class="table-border-bottom-0">
                                @include('vendor.orders._orders')
                              </tbody>
                            </table>
                          </div>
                        
                    </div>
                </div>
                
                     
            </div>
        </div>
        
    </div>
</div>
@endsection