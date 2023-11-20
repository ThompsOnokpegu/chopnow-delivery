<div class="card-body">
    @if(session()->has('default-contact'))
        <div class="alert alert-success">
            {{ session('default-contact') }}
        </div>
    @endif
    <form>
      <div class="row">
        <div class="mb-3 col-md-6">
          <label for="street" class="form-label">Street Name</label>
          <input 
            class="form-control" 
            type="text" 
            wire:model="street" 
            id="street" 
            
            @error('street') <div class="error">{{ $message }}</div> @enderror
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
      <div class="mt-2">
        <button wire:click.prevent="updateContact" class="btn btn-primary me-2">Save changes</button>
      </div> 
    </form> 
  </div>
