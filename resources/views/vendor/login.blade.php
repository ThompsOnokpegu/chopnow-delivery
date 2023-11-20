@extends('vendor.layouts.guest')

@section('form')
@if (session()->has('message'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('message') }} 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<form id="formAuthentication" class="mb-3" action="{{ route('vendor.verify') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">Email or Username</label>
      <input
        type="email"
        class="form-control"
        id="email"
        name="email"
        placeholder="Enter your email or username"
        autofocus
        :value="old('email')" required
      />
      @error('email') <div class="error">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3 form-password-toggle">
      {{-- <div class="d-flex justify-content-between">
        <label class="form-label" for="password">Password</label>
        <a href="auth-forgot-password-basic.html">
          <small>Forgot Password?</small>
        </a>
      </div> --}}
      <div class="input-group input-group-merge">
        <input
          type="password"
          id="password"
          class="form-control"
          name="password"
          aria-describedby="password"
        />
        @error('password') <div class="error">{{ $message }}</div> @enderror
        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
      </div>
    </div>
    {{-- <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="remember-me" />
        <label class="form-check-label" for="remember-me"> Remember Me </label>
      </div>
    </div> --}}
    <div class="mb-3">
      <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
    </div>
</form>
<p class="text-center">
    <span>New on our platform?</span>
    <a href="{{ route('vendor.register') }}">
      <span>Create an account</span>
    </a>
</p>
@endsection