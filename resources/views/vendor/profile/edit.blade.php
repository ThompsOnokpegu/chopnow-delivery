@extends('vendor.layouts.account')

@section('account')
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
      @if($message=session('message'))
        <div class="alert alert-success">
          {{ $message }}
        </div>
      @endif
      <div class="row">
        <form action="{{ route('vendor.update',$vendor->id) }}" method="post">
          @method('put')
          @csrf
        <div class="col-md-12">
          @include('vendor.profile._header')
          <div class="card mb-4">
            <h5 class="card-header">Business Owner</h5>
            <!-- Account -->
            <hr class="my-0" />
            <div class="card-body">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="first_name" class="form-label">First Name <span class="error">*</span> </label>
                    <input
                      class="form-control"
                      type="text"
                      id="first_name"
                      name="first_name"
                      value="{{ old('first_name',$vendor->first_name) }}"
                      autofocus
                    />
                    @error('first_name') <div class="error">{{ $message }}</div> @enderror
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input 
                      class="form-control" 
                      type="text" 
                      name="last_name" 
                      id="last_name" 
                      value="{{ old('last_name',$vendor->last_name) }}" />
                      @error('last_name') <div class="error">{{ $message }}</div> @enderror
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input
                      class="form-control"
                      type="text"
                      id="email"
                      name="email"
                      value="{{ old('email',$vendor->email) }}"
                      placeholder="john.doe@example.com"
                      disabled
                    />
                    @error('email') <div class="error">{{ $message }}</div> @enderror
                  </div>
                  <div class="mb-3 col-md-6">
                      <label class="form-label" for="phone">Phone Number</label>
                      <div class="input-group input-group-merge">
                        <span class="input-group-text">NG (+234)</span>
                        <input
                          type="text"
                          id="phone"
                          name="phone"
                          class="form-control"
                          placeholder="202 555 0111"
                          value="{{ old('phone',$vendor->phone) }}"
                        />
                      </div>
                      @error('phone') <div class="error">{{ $message }}</div> @enderror
                  </div>
                </div>                  
              <!-- </form> -->
            </div>
          </div>
          <!-- /Account -->
          <div class="card mb-4">
            <h5 class="card-header">Business Details</h5>
            <!-- Account -->
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                  src="{{ asset('vendor/assets/img/avatars/brand-image.png') }}"
                  alt="brand-image"
                  class="d-block rounded"
                  height="100"
                  width="100"
                  id="preview"
                  />
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Change Display Image</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input
                      type="file"
                      id="upload"
                      class="account-file-input"
                      hidden
                      name="kitchen_banner_image"
                      accept="image/png, image/jpeg"
                      value="{{ old('kitchen_banner_image',$vendor->kitchen_banner_image) }}"
                    /> 
                  </label>
                  
                  <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                  <i class="bx bx-reset d-block d-sm-none"></i>
                  <span class="d-none d-sm-block">Reset</span>
                  </button>
                  <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 200K</p>
                  @error('kitchen_banner_image') <div class="error">{{ $message }}</div> @enderror
                </div>
              </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
              <!-- <form id="formAccountSettings" method="POST" onsubmit="return false"> -->
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="business_name" class="form-label">Name</label>
                    <input
                      class="form-control"
                      type="text"
                      id="business_name"
                      name="business_name"
                      value="{{ old('business_name',$vendor->business_name) }}"
                    />
                    @error('business_name') <div class="error">{{ $message }}</div> @enderror
                  </div>
                  
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="business_phone">Phone Number</label>
                    <div class="input-group input-group-merge">
                      <span class="input-group-text">NG (+234)</span>
                      <input
                        type="text"
                        id="business_phone"
                        name="business_phone"
                        class="form-control"
                        placeholder="202 555 0111"
                        value="{{ old('business_phone') }}"
                      />
                      @error('business_phone') <div class="error">{{ $message }}</div> @enderror
                    </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input 
                      class="form-control" 
                      type="text" 
                      name="address" 
                      id="address" 
                      value="{{ old('address',$vendor->address) }}" />
                      @error('address') <div class="error">{{ $message }}</div> @enderror
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input 
                      type="text" 
                      class="form-control" 
                      id="city" 
                      name="city" 
                      placeholder="Calabar"
                      value="{{ old('city',$vendor->city) }}" />
                      @error('city') <div class="error">{{ $message }}</div> @enderror
                  </div>
                  <div class="mb-3 col-md-6">
                      <label for="language" class="form-label">State</label>
                      <select id="language" name="state" class="select2 form-select">
                        <option value="">Select State</option>
                        <option value="Akwa Ibom" @selected("Akwa Ibom"== old('state',$vendor->state))>Akwa Ibom</option>
                        <option value="Bayelsa" @selected("Bayelsa"== old('state',$vendor->state))>Bayelsa</option>
                        <option value="Cross River" @selected("Cross River"== old('state',$vendor->state))>Cross River</option>
                        <option value="Rivers" @selected("Rivers"== old('state',$vendor->state))>Rivers</option>
                      </select>
                      @error('state') <div class="error">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="mt-2">
                  <button type="submit" class="btn btn-primary me-2">Save changes</button>
                </div>
              </form>
            </div>
            <!-- /Account -->
          </div>
          <div class="card">
            <h5 class="card-header">Delete Account</h5>
            <div class="card-body">
              <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                  <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                  <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
              </div>
              <form >
                <div class="form-check mb-3">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    name="accountActivation"
                    id="accountActivation"
                  />
                  <label class="form-check-label" for="accountActivation"
                    >I confirm my account deactivation</label
                  >
                </div>
                <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
</form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
