<form>
    
    <div class="mb-3 col-md-6">
      <label for="confirm">Type DELETE then click deactivate account to confirm your decision</label>
      <input 
            type="text" 
            class="form-control" 
            
            wire:model="confirmation" 
            placeholder="DELETE"
             />
    </div>
    @if(session()->has('match'))
        <div class="alert alert-info">
            {{ session('match') }}
        </div>
    @endif
    @error('confirmation') <div class="error">{{ $message }}</div> @enderror
    <button wire:click.prevent="deactivateAccount" class="btn btn-danger deactivate-account">Deactivate Account</button>
</form>
