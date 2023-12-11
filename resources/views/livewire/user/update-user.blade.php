<div class="card-body">
    @if(session()->has('basic-info'))
        <div class="alert alert-success">
            {{ session('basic-info')}}
        </div>
    @endif
    <form>
    <div class="row">
      <div class="mb-3 col-md-12">
        <label for="email" class="form-label">E-mail</label>
        <input
          class="form-control"
          type="text"
          id="email"
          wire:model="email"
          placeholder="john.doe@example.com"
          disabled
        />
        @error('email') <div class="error">{{ $message }}</div> @enderror
      </div>
      <div class="mb-3 col-md-6">
        <label for="first_name" class="form-label">First Name <span class="error">*</span> </label>
        <input
          class="form-control"
          type="text"
          id="first_name"
          wire:model="first_name"
          
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
      <div class="mt-2">
        <button wire:click.prevent="updateUser" class="btn btn-primary me-2">Save changes</button>
      </div> 
    </div>                  
  </form>
</div>