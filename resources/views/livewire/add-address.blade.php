<div wire:ignore.self class="modal" id="address-popup" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
            <h6 class="text-center">Add a delivery address</h6>
            @if (session()->has('message'))
                <p class="alert alert-success">{{ session('message') }} <i data-bs-dismiss="modal" ><strong>close</strong></i></span>
            @endif
            <div class="input-group mb-3 mt-3">
                <input style="border-radius: 25px 0px 0px 25px;" type="text" wire:model='address' class="form-control" placeholder="234 Drive Calabar" aria-label="234 Drive Calabar" aria-describedby="button-addon2">
                <button style="border-radius: 0px 25px 25px 0px;" class="btn btn-base" type="button" wire:click="add"><img src="{{ asset('customer/assets/img/icon/target24.png') }}" width="20">Add</button>
            </div>
        </div>
      </div>
    </div>
</div>
