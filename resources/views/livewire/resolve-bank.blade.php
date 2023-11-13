<div>
  @if (!$hasPayoutAccount)
    <div class="mb-3 col-12 mb-0">
      <div class="alert alert-warning">
        <h6 class="alert-heading fw-bold mb-1">Why do I need to enter my bank account?</h6>
        <p class="mb-0">We want to ensure that the money is sent to the right account when you request payout.</p>
      </div>
    </div>
    <form wire:loading.remove>
      <div class="row">
        <div class="mb-3 col-md-12">
          <label for="Name" class="form-label">
            @if($account_name)
                <div class="alert alert-success">
                    <p>Payout account created for {{ $account_name }}
                </div>
            @endif 
          </label>
        </div>
        <div class="mb-3 col-md-12">
          <label for="Name" class="form-label">Account Number</label>
          <input
            class="form-control"
            type="text"
            id="account_number"
            wire:model="account_number"/>
        </div>
        <div class="mb-4 col-md-12">
          <label for="language" class="form-label">Bank Name</label>
          <select id="language" wire:model="bank_code" class="select2 form-select" autofocus>
            <option value="">Select Bank</option>
            @foreach ($banks as $bank)
                <option value="{{ $bank['code'] }}">{{ $bank['name'] }}</option>
            @endforeach
          </select>
        </div>
      </div>
      
      <button wire:click.prevent="resolve" class="btn btn-primary me-2 mb-4">
        Submit Account
      </button> 
    </form>
    <div wire:loading class="demo-inline-spacing">
      <div class="spinner-border text-primary" role="status"></div>
      <span class="visuall-hidden">Fetching your account...</span>
    </div>
  @else
    <div class="mb-3 col-12 mb-0">
      <div class="alert alert-primary">
        <h6 class="alert-heading fw-bold mb-1">Account Details</h6>
        <p class="mb-0">
          {{ $account_name }}<br>
          {{ $account_number }}<br>
          {{ $bank_name }}
        </p>
      </div>
    </div>
  @endif  
    
</div>
