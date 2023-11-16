@extends('frontend.restaurant.layouts.main')

@section('content')
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel">Modal 1</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="align-items-center d-flex justify-content-center">
                    <div class="register-page pt-4">
                        <a class="btn back-page-btn" href="{{ route('restaurants.index') }}"><i class="ri-arrow-left-s-line"></i></a>
                        <h3>Welcome</h3>
                        <p>Let’s register you.</p>
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
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Continue</button>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="align-items-center d-flex justify-content-center">
                    <div class="login-page pt-4">
                        <a class="btn back-page-btn" href="{{ route('user.register') }}"><i class="ri-arrow-left-s-line"></i></a>
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
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#exampleModalToggle3" data-bs-toggle="modal" data-bs-dismiss="modal">Continue</button>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel3" tabindex="-1">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalToggleLabel3">Modal 3</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h6 class="text-center">Add a delivery address</h6>
            @if (session()->has('message'))
                <p class="alert alert-success">{{ session('message') }} <i data-bs-dismiss="modal" ><strong>close</strong></i></span>
            @endif
            <div class="input-group mb-3 mt-3">
                <input style="border-radius: 25px 0px 0px 25px;" type="text" wire:model='address' class="form-control" placeholder="234 Drive Calabar" aria-label="234 Drive Calabar" aria-describedby="button-addon2">
                <button style="border-radius: 0px 25px 25px 0px;" class="btn btn-base" type="button" wire:click="add"><img src="{{ asset('customer/assets/img/icon/target24.png') }}" width="20">Add</button>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button>
        </div>
      </div>
    </div>
</div>
<a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open first modal</a>
@endsection