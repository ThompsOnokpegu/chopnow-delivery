<div class="row">
    <form>
      @method('put')
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
                    wire:model="first_name"
                    
                    autofocus
                  />
                  @error('first_name') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="last_name" class="form-label">Last Name</label>
                  <input 
                    class="form-control" 
                    type="text" 
                    wire:model="last_name" 
                    id="last_name" 
                    
                    @error('last_name') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="email" class="form-label">E-mail</label>
                  <input
                    class="form-control"
                    type="text"
                    id="email"
                    wire:model="email"
                    
                    placeholder="john.doe@example.com"
                    readonly
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
                        wire:model="phone"
                        class="form-control"
                        placeholder="202 555 0111"
                        
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
              
                @if ($kitchen_banner_image)
                <img src="{{ $kitchen_banner_image->temporaryUrl() }}" class="rounded-full w-32 h-32 mx-auto shadow-md">
                     
                 @else
                    <img
                    src="{{ asset('vendor/assets/img/brands/'.$kitchen_banner_image) }}"
                    alt="brand-image"
                    class="d-block rounded"
                    height="100"
                    width="100"
                    id="preview"
                    />
                 @endif
              
              <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                  <span class="d-none d-sm-block">Change Display Image</span>
                  <i class="bx bx-upload d-block d-sm-none"></i>
                  <input
                    type="file"
                    id="upload"
                    class="account-file-input"
                    hidden
                    wire:model="kitchen_banner_image"
                    
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
                    wire:model="business_name"
                    
                  />
                  @error('business_name') <div class="error">{{ $message }}</div> @enderror
                </div>
                @livewire('make-slug')
              
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="business_phone">Phone Number</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text">NG (+234)</span>
                    <input
                      type="text"
                      id="business_phone"
                      wire:model="business_phone"
                      class="form-control"
                      placeholder="202 555 0111"
                      
                    />
                    @error('business_phone') <div class="error">{{ $message }}</div> @enderror
                  </div>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="address" class="form-label">Address</label>
                  <input 
                    class="form-control" 
                    type="text" 
                    wire:model="address" 
                    id="address" 
                    
                    @error('address') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3 col-md-6">
                  <label for="city" class="form-label">City</label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="city" 
                    wire:model="city" 
                    placeholder="Calabar"
                    
                    @error('city') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="language" class="form-label">State</label>
                    <select id="language" wire:model="state" class="select2 form-select">
                      <option value="">Select State</option>
                      <option value="Akwa Ibom" @selected("Akwa Ibom"== old('state',$state))>Akwa Ibom</option>
                      <option value="Bayelsa" @selected("Bayelsa"== old('state',$state))>Bayelsa</option>
                      <option value="Cross River" @selected("Cross River"== old('state',$state))>Cross River</option>
                      <option value="Rivers" @selected("Rivers"== old('state',$state))>Rivers</option>
                    </select>
                    @error('state') <div class="error">{{ $message }}</div> @enderror
                </div>
              </div>
              <div class="mt-2">
                <button wire:click.prevent="update" class="btn btn-primary me-2">Save changes</button>
              </div>
            
          </div>
          <!-- /Account -->
        </div>
        
      </div>
    </form>
  </div>