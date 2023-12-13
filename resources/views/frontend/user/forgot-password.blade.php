@extends('frontend.checkout.layouts.main')

@section('content')
    <div class="container">
        <div class="forget-pass-page btn-bottom-fixed">
            <a class="btn back-page-btn" href="{{ route('user.login') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3>Forgot Password?</h3>
            <p>Enter your email and we'll send you instructions to reset your password</p>
            @if(session()->has('status') || session()->has('email'))
                <div class="alert alert-info">
                    {{ session('status') .' '.session('email') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="default-form-wrap">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label><img src="customer/assets/img/icon/message.svg" alt="img"></label>
                            <input type="text" name="email" class="form-control" placeholder="mra.anik0@gmail.com">
                        </div>
                    </div>
                </div>
                <span class="another-way-link"><a href="{{ route('user.login') }}">Back to login</a></span>
                <div class="btn-fixed-wrap">
                    <button class="btn btn-base w-100" type="submit">Send Reset Link</button>
                </div>
            </form>
            
        </div> 
    </div>
@endsection