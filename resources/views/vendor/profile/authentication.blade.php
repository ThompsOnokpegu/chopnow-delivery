@extends('vendor.layouts.account')

@section('account')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Auth</h4>

    <div class="row">
      <div class="col-md-12">
        @include('vendor.profile._header')
        <div class="card mb-4">
          <h5 class="card-header">Change Password</h5>
          <!-- Account -->
          
          <hr class="my-0" />
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
            @elseif (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form id="formAccountSettings" method="POST" action="{{ route('vendor.resetpassword') }}">
              @method('put')
              @csrf
              <!-- Password Reset Token -->
              
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="current_password" class="form-label">Current Password</label>
                  <input
                    class="form-control"
                    type="password"
                    id="current_password"
                    name="current_password"
                    autofocus
                  />
                  @error('current_password') <div class="error">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3 col-md-12">
                  <label for="new_password" class="form-label">New Password</label>
                  <input class="form-control" type="password" name="new_password" id="new_password" />
                  @error('new_password') <div class="error">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="new_password_confirmation">Confirm New Password</label>
                    <div class="input-group input-group-merge">
                      
                      <input
                        type="password"
                        id="new_password_confirmation"
                        name="new_password_confirmation"
                        class="form-control"
                      />
                    </div>
                    @error('new_password_confirmation') <div class="error">{{ $message }}</div> @enderror
                </div> 
                                 
              </div>
              <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
          </div>
          <!-- /Account -->
        </div>
      </div>
    </div>
</div>
@endsection
