<div wire:ignore.self class="modal" tabindex="-1" id="searchModal" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header" style="border-bottom:0px;"> 
        <h6 class="modal-title mb-2">Search Restaurants</h6> 
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
            <!-- search popup area start -->
            <div class="home-search-wrap">
                <div class="default-form-wrap">
                    <div class="single-input-wrap">
                        <label><img src="{{ asset('customer/assets/img/icon/search.svg') }}" alt="img"></label>
                        <input wire:model.live="search" type="text" class="form-control" placeholder="Search restaurants">
                    </div>
                    <button type="button" class="btn btn-border">
                        <img src="{{ asset('customer/assets/img/icon/filter.svg') }}" alt="img">
                    </button>
                </div>
            </div>   
            <!-- //. search Popup -->
            @if($restaurants->count()<1)
                <div class="text-center"><a style="font-weight:900;font-size:24px;" href="{{ route('restaurants.index') }}">View All</a></div>
            @endif
            @foreach($restaurants as $restaurant)
            
                <div class="single-product-wrap">
                    <div class="thumb">
                        {{-- <span class="tag">15% Off</span> --}}
                        <a href="{{ route('restaurants.show',$restaurant->id) }}">
                            <img src="{{ asset('vendor/assets/img/brands/'.$restaurant->kitchen_banner_image) }}" alt="img">
                        </a>
                        <a class="fav-btn" href="#"><i class="fa fa-heart"></i></a>
                    </div>
                    <div class="details">
                        <h6><a href="{{ route('restaurants.show',$restaurant->id) }}">{{ $restaurant->business_name }}</a> <span></span></h6>
                        <div class="ratting">
                            <i class="ri-star-fill ps-0"></i>4.9
                            <span>(6k)</span>
                            <span>20-25 Min <span class="ms-3"><i class="fa fa-motorcycle"></i> ₦500.00</span></span>
                            
                        </div>
                        
                    </div>
                </div> 
            @endforeach
        </div>
      </div>
    </div>
</div>