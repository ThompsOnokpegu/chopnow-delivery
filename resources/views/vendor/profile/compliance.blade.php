@extends('vendor.layouts.account')

@section('account')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Compliance</h4>

    <div class="row">
      <div class="col-md-12">
        @include('vendor.profile._header')
        <div class="card mb-4">
          <h5 class="card-header">KYC Compliance</h5>
          <!-- Account -->
          
          <hr class="my-0" />
          <div class="card-body">
            <form id="formAccountSettings" method="POST" onsubmit="return false">
              <div class="row">
                
                <div class="mb-3 col-md-12">
                  <label for="language" class="form-label">Verification Type</label>
                  <select id="language" name="kyc_type" class="select2 form-select" autofocus>
                    <!--https://docs.verifyme.ng/identity-verifications/bank-verification-number-->
                    <!--https://paystack.com/docs/identity-verification/validate-customer/-->
                    <option value="">Select Document</option>
                    <option value="BVN">BVN</option>
                    <option value="NIN">NIN</option>
                    <option value="Driver License">Drivers License</option>
                  </select>
                </div>
                <div class="mb-3 col-md-12">
                  <label for="kyc_number" class="form-label">Document Number</label>
                  <input
                    class="form-control"
                    type="text"
                    id="kyc_number"
                    name="kyc_number"
                  
                  />
                </div>
                <div class="button-wrapper col-md-12">
                  <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Upload Document</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input
                      type="file"
                      id="upload"
                      name="kyc_document"
                      class="account-file-input"
                      hidden
                      accept="image/png, image/jpeg"
                    />
                  </label>
                  <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                  </button>
  
                  <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 200K</p>
                </div>            
              </div>
              
            </form>
          </div>
          <!-- /Account -->
        </div>
        <div class="card">
          <h5 class="card-header">Account Status</h5>
          <div class="card-body">
            
            <form id="formAccountDeactivation" onsubmit="return false">
              <div class="form-check mb-3">
                <input
                  class="form-check-input"
                  type="checkbox"
                  name="accountActivation"
                  id="accountActivation"
                  checked
                />
                <label class="form-check-label" for="accountActivation">Identity Verification</label>
              </div>
              <div class="form-check mb-3">
                <input
                  class="form-check-input"
                  type="checkbox"
                  name="accountActivation"
                  id="accountActivation"
                />
                <label class="form-check-label" for="accountActivation">Email Verification</label>
              </div>  
              <div class="form-check mb-3">
                <input
                  class="form-check-input"
                  type="checkbox"
                  name="accountActivation"
                  id="accountActivation"
                  checked
                />
                <label class="form-check-label" for="accountActivation">Business Setup</label>
              </div>  
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
