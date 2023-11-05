@extends('frontend.checkout.layouts.main')

@section('content')
<div class="container">
    <div class="align-items-center d-flex justify-content-center">
        <div class="login-page pt-4">
            <a class="btn back-page-btn" href="onboard.html"><i class="ri-arrow-left-s-line"></i></a>
            <h3>Let’s sign you in.</h3>
            <p>Welcome back to our Food delivery app. Search your favourte food.</p>
            <form class="default-form-wrap" action="{{ route('login') }}" method="POST">
                @csrf()
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label><img src="{{'customer/assets/img/icon/profile.svg'}}" alt="img"></label>
                            <input name="email" value="{{ old('email') }}" type="text" class="form-control" placeholder="Email or username">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label><img src="{{'customer/assets/img/icon/password.svg'}}" alt="img"></label>
                            <input name="password" type="password" class="form-control" placeholder="Password">
                            <button class="show-pass-btn"><img src="{{'customer/assets/img/icon/eye.svg'}}" alt="img"></button>
                        </div>
                    </div>
                    <div class="text-end"><a href="forget-pass.html">Forgot password?</a></div>
                </div>
                <button type="submit" class="btn btn-base w-100">Sign In</button>
            </form>
            
            <span class="another-way-link">Don’t have an account? <a href="{{ route('user.register') }}">Registor</a></span>
        </div>           
    </div>
</div>
@endsection