@extends('vendor.layouts.guest')

@section('form')
    <!-- Content -->
    <h4 class="mb-2">Reset Password 🔒</h4>
    <p class="mb-4">Enter your new password</p>
    <form id="formAuthentication" class="mb-3" action="{{ route('vendor.password.update') }}" method="POST">
      @csrf
      @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
      @endif
      @if(session()->has('error'))
        <div class="alert alert-info">
            {{ session('error') }}
        </div>
      @endif
      <input type="hidden" name="token" value="{{ $token }}">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input
          type="email"
          class="form-control"
          id="email"
          name="email"
          placeholder="Enter your email"
          autofocus
        />
        @error('email') <div class="error">{{ $message }}</div> @enderror
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Password</label>
        <input
          type="password"
          class="form-control"
          id="password"
          name="password"
          placeholder="Enter your email"
        />
        @error('password') <div class="error">{{ $message }}</div> @enderror
      </div>
      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input
          type="password"
          class="form-control"
          id="password_confirmation"
          name="password_confirmation"
          placeholder="Enter your email"
        />
        @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror
      </div>
      
      <button type="submit" class="btn btn-primary d-grid w-100">Change Password</button>
    </form>
@endsection
    <!-- / Content -->


    