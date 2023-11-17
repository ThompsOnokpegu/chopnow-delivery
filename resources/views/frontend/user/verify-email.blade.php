@extends('frontend.checkout.layouts.main')

@section('content')
    <div class="container">
        <div class="align-items-center d-flex justify-content-center">
            <div class="register-verify-page  pt-1">
                <a class="btn back-page-btn" href="register.html"><i class="ri-arrow-left-s-line"></i></a>
                <h3>Verify your email!</h3>
                <p>Could you verify your email address by clicking on the link we emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        A new verification link has been sent to the email address you provided during registration.
                    </div>
                @endif
                <div class="text-cente">
                    <p class="mb-0">I didn’t recevie a code!</p>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <a class="btn btn-base" href="{{ route('verification.send') }}"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                          Resend Link
                        </a>
                    </form>
                    
                    <form method="POST" action="{{ route('user.logout') }}">
                        @csrf
                        <a class="link-btn mt-3" href="{{ route('user.logout') }}"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                          Log Out
                        </a>
                    </form>
                                 
                </div>  
                            
            </div>           
        </div>
    </div>
@endsection