
<div class="container-xxl flex-grow-1 container-p-y">
    
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Compliance</h4>

    <div class="row">
      <div class="col-md-12">
        @include('vendor.profile._header')
        <div class="card mb-4">
          @if(session()->has('kyc-compliant'))
            <div class="alert alert-danger">
              {{ session('kyc-compliant') }}
            </div>
          @endif
          <h5 class="card-header">KYC Compliance</h5>
          <!-- Account -->
          
          <hr class="my-0" />
          @if ($business=='Registered')
            @if($approved == "approved")
            <div class="card-body">
              <div class="alert alert-success">APPROVED!</div>
            </div>
            @else
              <div class="card-body">
                @if(session()->has('kyc-uploaded'))
                  <div class="alert alert-success">
                    {{ session('kyc-uploaded') }}
                  </div>
                @endif
                <form wire:submit="comply">
                <div class="row">
                    
                    <div class="mb-3 col-md-12">
                    <label for="language" class="form-label">Business Registration Type</label>
                    <select id="language" wire:model="kyc_type" class="select2 form-select" autofocus>
                        <!--https://docs.verifyme.ng/identity-verifications/bank-verification-number-->
                        <!--https://paystack.com/docs/identity-verification/validate-customer/-->
                        <option value="">Select</option>
                        <option value="BN">BN Registration</option>
                        <option value="CAC">Limited Liability Company</option>
                        
                    </select>
                    @error('kyc_type') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3 col-md-12">
                    <label for="kyc_number" class="form-label">Registration Number</label>
                    <input
                        class="form-control"
                        type="text"
                        id="kyc_number"
                        wire:model="kyc_number"
                    
                    />
                    @error('kyc_number') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="button-wrapper col-md-12">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload Certificate</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input
                        type="file"
                        id="upload"
                        wire:model="kyc_document"
                        class="account-file-input"
                        hidden
                        accept="image/png, image/jpeg, application/pdf"
                        />
                        @error('kyc_document') <span class="error">{{ $message }}</span> @enderror
                    </label>
                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                    </button>
                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 200K</p>
                    </div>

                                
                </div>
                <div class="mt-5" wire:loading.remove>
                    <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                </div>
                <div wire:loading>
                    <img width="48" height="48" src="https://img.icons8.com/color/48/spinner-frame-5.png" alt="spinner-frame-5"/>
                </div>
                </form>
              </div>
          <!-- /Account -->
            @endif            
          @else
            @if($approved == "approved")
              <div class="card-body">
                <div class="alert alert-success">APPROVED!</div>
              </div>
            @else
            <div class="card-body">
              <div class="alert alert-success">Set your Payout Account! <a style="font-weight: 900;" href="{{ route('vendor.payout') }}">Payout</a></div>
            </div>
            @endif
          @endif
        </div>
        {{-- <div class="card">
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
        </div> --}}
      </div>
    </div>
</div>  

