<div class="home-product-slider owl-carousel">
    @foreach ($nearby as $restaurant)
        <div class="single-product-wrap">
            <div class="thumb">
                <span class="tag">15% Off</span>
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