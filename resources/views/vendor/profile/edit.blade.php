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
        <form action="{{ route('vendor.update',$vendor->id) }}" method="post" enctype="multipart/form-data">
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
                      <p class="text-muted mb-0">{{ $vendor->email }}</p>
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
                    src="{{ url(env('CLOUD_BASE_URL') . $vendor->kitchen_banner_image) }}"
                    alt="brand-image"
                    class="d-block rounded"
                    height="100"
                    width=auto
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
                      <label for="business_name" class="form-label">Business Name</label>
                      <input
                        class="form-control"
                        type="text"
                        id="business_name"
                        name="business_name"
                        wire:model="business_name"
                        value="{{ old('business_name',$vendor->business_name) }}"
                      />
                      @error('business_name') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="language" class="form-label">Restaurant Type</label>
                      <select id="language" name="restaurant_type_id" class="select2 form-select">
                          <option value="">Restaurant Type</option>
                          @foreach($restaurantTypes as $type)
                              <option id="{{ $type->slug }}" value='{{ $type->id }}' {{ $type->id == old('restaurant_type_id', $vendor->restaurant_type_id) ? 'selected' : '' }}>
                                  {{ $type->type }}
                              </option>
                          @endforeach
                      </select>
                      @error('restaurant_type') <div class="error">{{ $message }}</div> @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="business_phone">Business Phone</label>
                      <div class="input-group input-group-merge">
                        <span class="input-group-text">NG (+234)</span>
                        <input
                          type="text"
                          id="business_phone"
                          name="business_phone"
                          class="form-control"
                          placeholder="202 555 0111"
                          value="{{ old('business_phone',$vendor->business_phone) }}"
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
                    <div class="mb-3 col-md-6">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="language" class="form-label">Prep Time<small> (mins)</small></label>
                            <select id="language" name="preparation_time" class="select2 form-select">
                              <option value="">Prep Time</option>
                              <option value=15 @selected(15 == old('preparation_time',$vendor->preparation_time))>15 mins</option>
                              <option value=20 @selected(20 == old('preparation_time',$vendor->preparation_time))>20 mins</option>
                              <option value=25 @selected(25 == old('preparation_time',$vendor->preparation_time))>25 mins</option>
                              <option value=30 @selected(30 == old('preparation_time',$vendor->preparation_time))>30 mins</option>
                              <option value=35 @selected(35 == old('preparation_time',$vendor->preparation_time))>35 mins</option>
                              <option value=40 @selected(40 == old('preparation_time',$vendor->preparation_time))>40 mins</option>
                              <option value=45 @selected(45 == old('preparation_time',$vendor->preparation_time))>45 mins</option>
                              <option value=50 @selected(50 == old('preparation_time',$vendor->preparation_time))>50 mins</option>
                              <option value=55 @selected(55 == old('preparation_time',$vendor->preparation_time))>55 mins</option>
                              <option value=60 @selected(60 == old('preparation_time',$vendor->preparation_time))>60 mins</option>
                            </select>
                            <small>How soon can you deliver your orders?</small>
                            @error('preparation_time') <div class="error">{{ $message }}</div> @enderror
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="language" class="form-label">Delivery Fee</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">₦</span>
                              <input type="text" 
                                name="delivery_fee" 
                                value="{{ old('delivery_fee',$vendor->delivery_fee) }}" 
                                class="form-control" 
                                placeholder="100" 
                                aria-label="Amount (to the nearest Naira)">
                              <span class="input-group-text">NGN</span>
                            </div>
                            @error('delivery_fee') <div class="error">{{ $message }}</div> @enderror
                          </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="language" class="form-label">Business Type<small> (mins)</small></label>
                      <select id="language" name="business_type" class="select2 form-select">
                        <option value="">Business Type</option>
                        <option value='Personal' @selected('Personal' == old('business_type',$vendor->business_type))>Personal Business</option>
                        <option value='Registered' @selected('Registered' == old('business_type',$vendor->business_type))>Registered Business</option>
                      </select>
                      <small>Registered business require extra verification</small>
                      @error('business_type') <div class="error">{{ $message }}</div> @enderror
                    </div>
                  </div>
                  <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                  </div>  
              </div>
              <!-- /Account -->
            </div> 
          </div>
        </form>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <h5 class="card-header">Delete Account</h5>
            <div class="card-body">
              <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                  <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                  <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
                <form action="{{ route('vendor.destroy') }}" method="POST">
                  @csrf
                  <div class="mb-3 col-md-6">
                    <label for="confirm">Type DELETE then click deactivate account to confirm your decision</label>
                    <input 
                          type="text" 
                          class="form-control" 
                          
                          name="confirm" 
                          placeholder="DELETE"
                           />
                  </div>
                  @error('confirm') <div class="error">{{ $message }}</div> @enderror
                  <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
@endsection
