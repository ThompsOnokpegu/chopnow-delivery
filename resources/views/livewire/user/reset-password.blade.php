<div class="card-body">
    <form >
        @if(session()->has('password-reset'))
        <div class="alert alert-success">
            {{ session('password-reset') }}
        </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="row">
          <div class="mb-3 col-md-12">
            <label for="current_password" class="form-label">Current Password</label>
            <input
              class="form-control"
              type="password"
              id="current_password"
              wire:model="current_password"
            />
            @error('current_password') <div class="error">{{ $message }}</div> @enderror
          </div>
          
          <div class="mb-3 col-md-12">
            <label for="new_password" class="form-label">New Password</label>
            <input class="form-control" type="password" wire:model="new_password" id="new_password" />
            @error('new_password') <div class="error">{{ $message }}</div> @enderror
          </div>            
        </div>
        <button wire:loading.remove wire:click.prevent="resetPassword" class="btn btn-primary">Change Password</button>
      </form>  
</div>
