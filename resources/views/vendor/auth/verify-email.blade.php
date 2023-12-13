@extends('vendor.layouts.guest')

@section('form')
    <!-- Content -->
    <h4 class="mb-2">Verify your email!</h4>
    <p class="mb-4">You need to verify your email address. If you didn't receive our email, you can request another one below.</p>
    @if (session()->has('message'))
        <div class="alert alert-success">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-info">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif
    <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('vendor.email.notice') }}">
        @csrf
        <a class="btn btn-primary d-grid w-100" 
            href="{{ route('vendor.email.notice') }}"
            onclick="event.preventDefault();
            this.closest('form').submit();">
          Resend Link
        </a>
    </form>
    
    <form method="POST" action="{{ route('vendor.logout') }}">
        @csrf
        <div class="text-center">
            <a class="d-flex align-items-center justify-content-center" 
                href="{{ route('vendor.logout') }}"
                onclick="event.preventDefault();
                this.closest('form').submit();">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Log Out
            </a>
        </div>
    </form>
@endsection
    <!-- / Content -->


    