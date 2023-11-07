<div class="home-product-slider owl-carousel">
    @foreach ($nearby as $restaurant)
        <div class="item">
            <div class="single-product-wrap">
                <div class="thumb">
                    <span class="tag">15% Off</span>
                    <a href="#">
                        <img src="{{ asset('vendor/assets/img/brands/'.$restaurant->kitchen_banner_image) }}" alt="img">
                    </a>
                    <a class="fav-btn" href="#"><i class="fa fa-heart"></i></a>
                </div>
                <div class="details">
                    <h6><a href="{{ route('restaurants.show',$restaurant->id) }}">{{ $restaurant->business_name }}</a> <span>Open</span></h6>
                    <div class="ratting">
                        <i class="ri-star-fill ps-0"></i>4.9
                        <span>(6k)</span>
                        <span>{{ $restaurant->address }}</span>
                    </div>
                    <span>20-25 Min <span class="ms-3">Free Delivery</span></span>
                </div>
            </div>
        </div>        
    @endforeach
</div> 