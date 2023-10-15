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
            <form id="formAccountSettings" method="POST" onsubmit="return false">
              <div class="row">
                <div class="mb-3 col-md-12">
                  <label for="password" class="form-label">Current Password</label>
                  <input
                    class="form-control"
                    type="password"
                    id="password"
                    name="password"
                    autofocus
                  />
                </div>
                <div class="mb-3 col-md-12">
                  <label for="lastName" class="form-label">New Password</label>
                  <input class="form-control" type="password" name="new_password" id="new_password" />
                </div>
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="comfirm_password">Confirm New Password</label>
                    <div class="input-group input-group-merge">
                      
                      <input
                        type="password"
                        id="comfirm_password"
                        name="comfirm_password"
                        class="form-control"
                      />
                    </div>
                </div>                  
              </div>
              <button type="submit" class="btn btn-primary deactivate-account">Change Password</button>
            </form>
          </div>
          <!-- /Account -->
        </div>
      </div>
    </div>
</div>
@endsection
