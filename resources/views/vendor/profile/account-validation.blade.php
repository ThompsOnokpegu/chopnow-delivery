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
            <div class="mb-3 col-12 mb-0">
              <div class="alert alert-warning">
                <h6 class="alert-heading fw-bold mb-1">Why do I need to enter my bank account?</h6>
                <p class="mb-0">We want to ensure that the money is sent to the right account when you request payout.</p>
              </div>
            </div>
            <form id="formAccountSettings" method="POST">
              @csrf
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="Name" class="form-label">Account Number</label>
                  <input
                    class="form-control"
                    type="text"
                    id="account_name"
                    name="account_name"
                    value="{{ $vendor->first_name.' '.$vendor->first_name }}"
                  />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="Name" class="form-label">Account Number</label>
                  <input
                    class="form-control"
                    type="text"
                    id="account_number"
                    name="account_number"/>
                </div>
                <div class="mb-4 col-md-12">
                  <label for="language" class="form-label">Bank Name</label>
                  <select id="language" name="bank_code" class="select2 form-select" autofocus>
                    <!--https://docs.verifyme.ng/identity-verifications/bank-verification-number-->
                    <!--https://paystack.com/docs/identity-verification/validate-customer/-->
                    <option value="">Select Bank</option>
                    @foreach ($banks as $bank)
                        <option value="{{ $bank['code'] }}">{{ $bank['name'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="button-wrapper col-md-12">
                  <button type="submit" class="btn btn-primary me-2 mb-4">
                    Verify Account
                  </button>  
                </div>            
              </div> 
            </form>
          </div>
          <!-- /Account -->
        </div>
      </div>
    </div>
  </div>
@endsection
