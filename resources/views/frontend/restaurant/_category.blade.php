<div class="home-category-slider owl-carousel">
    @foreach ($restaurant_types as $type)           
    <div class="item">
        <a class="home-category-item-wrap" href="{{ route('restaurants.filter',['category'=> $type->slug])}}">
            <img src="{{ asset('customer/assets/img/category/'. $type->slug .'.png') }}" alt="img">
            {{ $type->type}}
        </a>
    </div>
    @endforeach
</div>