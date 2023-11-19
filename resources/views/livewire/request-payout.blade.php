<div class="row">
    @if($hasPayoutAccount)

        <div class="col-md-6 align-self-center">
            <div class="report-list-item rounded-2">
                <div class="d-flex align-items-start">
                <div class="report-list-icon shadow-sm me-2" 
                style="
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 44px;
                min-width: 44px;
                box-shadow: 0 0.125rem 0.25rem rgba(161,172,184,.4) !important;
                background-color:#;
                ">
                    <img src="{{ asset('/vendor/assets/img/icons/wallet.png') }}" width="22" height="22" alt="Wallet">
                </div>
                <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                    <div class="d-flex flex-column">
                    <span>Balance</span>
                    <h5 class="mb-0">₦{{ $balance }}</h5>
                    </div>
                </div>
                </div>
                
            </div>    
        </div>
        
        <div class="col-md-6 mt-3">
            @if($data)
                <div class="alert alert-success">
                    ₦{{ $data['amount'] }} sent successfuly!
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <label class="form-label" for="basic-icon-default-company">Transfer Amount</label>
            <div class="input-group input-group-merge">
                <span class="input-group-text">₦</span>
                <input type="text" wire:model="amount" class="form-control" placeholder="100" aria-label="Amount (to the nearest Naira)">
                <span class="input-group-text">NGN</span>
            </div>
            @error('amount') <div class="error">{{ $message }}</div> @enderror
            <div wire:loading class="demo-inline-spacing">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="col-12 col-sm-3 mt-2" wire:loading.remove>
                <button wire:click.prevent="transfer" class="btn btn-primary"><i class="bx bx-check me-2"></i>Confirm</button>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            You have not provided your payout account!
        </div>
    @endif
</div>
