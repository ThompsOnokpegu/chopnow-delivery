@extends('vendor.layouts.account')

@section('account')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Payout</h4>
    <div class="row">
      <div class="col-md-12">
        @include('vendor.profile._header')
        <div class="card mb-4">
          <h5 class="card-header">Payout Account</h5>
          <!-- Account -->
          <hr class="my-0" />
          <div class="card-body">
                       
            {{-- livewire component --}}
            @livewire('resolve-bank') 
          </div>
          <!-- /Account -->
        </div>
          <div class="card mb-4">
            <h5 class="card-header">Request Payout</h5>
            <!-- Account -->
            <hr class="my-0" />
            <div class="card-body">
                        
              {{-- livewire component --}}
              @livewire('request-payout') 
            </div>
            <!-- /Account -->
          </div>
      </div>
    </div>
  </div>
@endsection
