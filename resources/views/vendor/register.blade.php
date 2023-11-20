@extends('vendor.layouts.guest')

@section('form')
<form id="formAuthentication" class="mb-3" action="{{ route('vendor.register') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="text" class="form-label">First Name</label>
      <input
        type="text"
        class="form-control"
        id="first_name"
        name="first_name"
        autofocus
      />
      @error('first_name') <div class="error">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email or Username</label>
      <input
        type="email"
        class="form-control"
        id="email"
        name="email"
      />
      @error('email') <div class="error">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3 form-password-toggle">
      <label for="password" class="form-label">Password</label>
      <div class="input-group input-group-merge">
        <input
          type="password"
          id="password"
          class="form-control"
          name="password"
          aria-describedby="password"
        />
        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
      </div>
      @error('password') <div class="error">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3 form-password-toggle">
      <label for="password" class="form-label">Confirm Password</label>
      <div class="input-group input-group-merge">
        <input
          type="password"
          id="password_confirmation"
          class="form-control"
          name="password_confirmation"
          aria-describedby="password_confirmation"
        />
        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        
      </div>
      
    </div>
    <div class="mb-3">
      <button class="btn btn-primary d-grid w-100" type="submit">Register</button>
    </div>
</form>
<p class="text-center">
    <span>Already registered?</span>
    <a href="{{ route('vendor.login') }}">
      <span>Login</span>
    </a>
</p>
@endsection