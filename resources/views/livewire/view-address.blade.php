<div class="media" style="margin: auto;">
    <img src="{{ asset('customer/assets/img/icon/map-marker.png') }}" alt="img" style="height: 18px;width:auto;">
    <div class="media" data-bs-toggle="modal" data-bs-target="#address-popup" wire:model='attempt'>    
        <span style="color:#000;">{{ session('delivery_address')==''? 'Add address' : session('delivery_address') }}<i class="ri-arrow-down-s-line"></i></span>
    </div>
</div>
