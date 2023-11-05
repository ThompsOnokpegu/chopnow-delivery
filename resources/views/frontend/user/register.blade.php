@extends('frontend.checkout.layouts.main')

@section('content')
<div class="container">
    <div class="align-items-center d-flex justify-content-center">
        <div class="register-page pt-4">
            <a class="btn back-page-btn" href="onboard.html"><i class="ri-arrow-left-s-line"></i></a>
            <h3>Let’s register you in.</h3>
            <p>Welcome back to our Food delivery app. Search your favorte food.</p>
            <form class="default-form-wrap" action="{{ route('user.create') }}" method="POST">
                @csrf()
               
                <div class="row">
                    @error('first_name') <div class=" mb-0 error">{{ $message }}</div> @enderror
                    <div class="col-12">
                        <div class="single-input-wrap">
                            <label><img src="{{ asset('customer/assets/img/icon/profile.svg') }}" alt="img"></label>
                            <input name="first_name" value="{{ old('first_name') }}" type="text" class="form-control" placeholder="Enter your first name">   
                        </div>
                        
                    </div>
                    @error('email') <div class="error">{{ $message }}</div> @enderror
                    <div class="col-12">
                        <div class="single-input-wrap">
                            <label><img src="{{ asset('customer/assets/img/icon/message.svg') }}" alt="img"></label>
                            <input name="email" value="{{ old('email') }}" type="text" class="form-control" placeholder="Enter your email">
                            
                        </div>
                    </div>
                    @error('password') <div class="error">{{ $message }}</div> @enderror
                    <div class="col-12">
                        <div class="single-input-wrap">
                            <label><img src="{{ asset('customer/assets/img/icon/password.svg') }}" alt="img"></label>
                            <input name="password" type="password" class="form-control" placeholder="Password">
                            <button class="show-pass-btn"><img src="{{ asset('customer/assets/img/icon/eye.svg') }}" alt="img"></button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-base w-100">Register Now</button>
            </form>
            
            <span class="another-way-link">Already have an account? <a href="{{ route('user.login') }}">Sign In</a></span>
        </div>           
    </div>
</div>

@endsection