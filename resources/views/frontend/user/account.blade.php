@extends('frontend.checkout.layouts.main')


@section('content')
<div class="container">
    <div class="profile-page-area">
        <div class="media">
            <div class="thumb">
                <img src="{{ asset('vendor/avatar.gif') }}" alt="img">
            </div>
            <div class="media-body">
                <h6>{{ Auth::user()->name .' '.Auth::user()->last_name }}</h6>
                <p>{{ Auth::user()->email }}</p>
            </div>
        </div>
        <div class="invite-wrap">
            <p>Invite Friends &
                You Both Get Up To ₦1000</p>
            <img src="{{ asset('customer/assets/img/gift.png') }}" alt="img">
        </div>
        <ul class="list-inner">
            <li>Account</li>
            {{-- <li><a href="#">Favourites <i class="ri-arrow-right-s-line"></i></a></li> --}}
            <li><a href="{{ route('user.chops') }}">Order <i class="ri-arrow-right-s-line"></i></a></li>
            <li><a href="{{ route('user.profile') }}">Profile <i class="ri-arrow-right-s-line"></i></a></li>
            <li style="color:#ccc"><a href="#">Vouchers <i class="ri-arrow-right-s-line"></i></a></li>
            <li style="color:#ccc"><a href="#">Help center <i class="ri-arrow-right-s-line"></i></a></li>
            <li style="color:#ccc"><a href="#">Term & Conditions / privacy<i class="ri-arrow-right-s-line"></i></a></li>
            <li>
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                <a href="{{ route('user.logout') }}"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
                    <span><i class="ri-logout-circle-line"> </i>Log Out</span>
                </a>
                </form>
            </li>
            {{-- <li><a href="#">Addresses <i class="ri-arrow-right-s-line"></i></a></li>
            <li><a href="#">Challenges & Rewards <i class="ri-arrow-right-s-line"></i></a></li> --}}
            {{-- <li><a href="#">Settings <i class="ri-arrow-right-s-line"></i></a></li> --}}
        </ul>
    </div>
    
</div> 
@endsection