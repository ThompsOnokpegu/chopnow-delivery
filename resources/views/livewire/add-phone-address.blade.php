<div class="container">
    <div class="align-items-center d-flex justify-content-center">
        <div class="login-page pt-4">
            @if(!session('delivery_address'))
            <a class="btn back-page-btn" href="{{ route('user.login') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3>Add a delivery address</h3>
            <p>Help our courier find you easily</p>
            <div class="input-group mb-3 mt-3">
                <input style="border-radius: 25px 0px 0px 25px;" type="text" wire:model='address' class="form-control" placeholder="234 Drive Calabar" aria-label="234 Drive Calabar" aria-describedby="button-addon2">
                <button style="border-radius: 0px 25px 25px 0px;" class="btn btn-base" type="button" wire:click="addAddress"><img src="{{ asset('customer/assets/img/icon/target24.png') }}" width="20">Add</button>
            </div>
            @endif
            @if(session('delivery_address'))
                <h3>Add a contact phone</h3>
                <p>Help our courier find you easily</p>
                <div class="input-group mb-3 mt-3">
                    <input style="border-radius: 25px 0px 0px 25px;" type="text" wire:model='phone' class="form-control" placeholder="08099999999" aria-describedby="button-addon2">
                    <button style="border-radius: 0px 25px 25px 0px;" class="btn btn-base" type="button" wire:click="addPhone"><img src="{{ asset('customer/assets/img/icon/phone.svg') }}" width="20">Add</button>
                </div>
            @endif
            
        </div>           
    </div>
</div>