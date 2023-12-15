<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">ORDER STATUS</h5>
    </div>
    <form>
      <div class="card-body">
        <div class="d-flex justify-content-between row gap-3 gap-md-0">
          <div class="col-md-12 product_status">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-success">
                    {{ session('error') }}
                </div>
            @endif
            
            <select id="OrderStatus" wire:model.live="order_status" class="form-select text-capitalize">
              <option value="">Status</option>
              <option @selected('Processing' == $order_status)>Processing</option>
              <option @selected('Enroute' == $order_status)>Enroute</option>
              <option @selected('Delivered' == $order_status)>Delivered</option>
              <option @selected('Canceled' == $order_status)>Canceled</option>
            </select>
            <div class="mt-3">
                @if($order_status == 'Canceled')
                  @if($timeLaps > 10)
                    <div class="alert alert-info">
                      <i class="menu-icon tf-icons bx bx-info-circle"></i> <span>Order cannot be cancelled after 10mins!</span>
                    </div>
                  @else
                    <label class="form-label" for="basic-default-reason">Reason for Cancellation</label>
                    <input type="text" wire:model="comment" class="form-control" id="basic-default-reason" />
                    <small>Let the customer know why you cannot fulfill this order.</small>
                    @error('comment') <div class="error">{{ $message }}</div> @enderror
                  @endif   
                @endif
            </div>
          </div>
          <div class="d-flex align-content-center flex-wrap mt-4">
            <button wire:click.prevent="updateOrderStatus" type="submit" class="btn btn-md btn-primary">Update</button>
          </div>
        </div>
      </div>
    </form>
  </div>
