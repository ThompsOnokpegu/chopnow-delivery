@extends('frontend.checkout.layouts.main')

@section('content')
<div class="container">
  <div class="forget-pass-page btn-bottom-fixed">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @if(session()->has('email'))
        <div class="alert alert-success">
            {{ session('email') }}
        </div>
        @endif
        
        <div class="row">
          <input type="hidden" name="token" value="{{ $token }}">
          <div class="mb-3 col-md-12">
            <label for="email" class="form-label">Email Address</label>
            <input
              class="form-control"
              type="email"
              id="email"
              name="email"
            />
            @error('email') <div class="error">{{ $message }}</div> @enderror
          </div>
          <div class="mb-3 col-md-12">
            <label for="password" class="form-label">New Password</label>
            <input
              class="form-control"
              type="password"
              id="password"
              name="password"
            />
            @error('password') <div class="error">{{ $message }}</div> @enderror
          </div>
          
          <div class="mb-3 col-md-12">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" />
            @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror
          </div>            
        </div>
        <button type="submit" class="btn btn-base">Update Password</button>
      </form> 
  </div> 
</div>

@endsection