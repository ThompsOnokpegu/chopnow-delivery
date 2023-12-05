<div class="container">
    <div class="align-items-center d-flex justify-content-center">
        <div class="login-page pt-4">
            <a class="btn back-page-btn" href="{{ route('user.register') }}"><i class="ri-arrow-left-s-line"></i></a>
            <h3>Let’s sign you in.</h3>
            <p>Welcome back to our Food delivery app. Search your favourte food.</p>
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form class="default-form-wrap">
                <div class="row">
                    @error('email')<div class="error">{{ $message }}</div>@enderror
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label><img src="{{'customer/assets/img/icon/profile.svg'}}" alt="img"></label>
                            <input wire:model="email" type="text" class="form-control" placeholder="Email or username">
                        </div>
                    </div>
                    @error('password')<div class="error">{{ $message }}</div>@enderror
                    <div class="col-md-6">
                        <div class="single-input-wrap">
                            <label><img src="{{'customer/assets/img/icon/password.svg'}}" alt="img"></label>
                            <input wire:model="password" type="password" class="form-control" placeholder="Password">
                            <i class="show-pass-btn"><img src="{{'customer/assets/img/icon/eye.svg'}}" alt="img"></i>
                        </div>
                    </div>
                    <div class="text-end"><a href="{{ route('password.request') }}">Forgot password?</a></div>
                </div>
                <button wire:click.prevent="login()" class="btn btn-base w-100">Sign In</button>
            </form>
            
            <span class="another-way-link">Don’t have an account? <a href="{{ route('user.register') }}">Registor</a></span>
        </div>           
    </div>
</div>
