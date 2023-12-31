@extends('frontend.user.account-layout')

@section('account')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4" style="color:#000;"><span class="text-muted fw-light">
      <a href="{{ route('user.account') }}" style="font-weight:600;">
        <i class="tf-icons bx bx-arrow-back"></i> Return
      </a> /</span> Update
    </h4>
    @if($message=session('message'))
      <div class="alert alert-success">
        {{ $message }}
      </div>
    @endif
    <div class="row"> 
        <div class="col-md-12"> 
          <div class="card mb-4">
            <h5 class="card-header">Account Information</h5>
            <!-- Account -->
            <hr class="my-0" />
            @livewire('user.update-user')
          </div>
          <!-- /Account -->
          <div class="card mb-4">
            <h5 class="card-header">Default Contact</h5>
            <!-- Account -->
            <hr class="my-0" />
            @livewire('user.update-contact')
            <!-- /Account -->
          </div> 
          <div class="card mb-4">
            <h5 class="card-header">Reset Password</h5>
            <!-- Account -->
            <hr class="my-0" />
            @livewire('user.reset-password')
            <!-- /Account -->
          </div> 
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <h5 class="card-header">Delete Account</h5>
          <div class="card-body">
            <div class="mb-3 col-12 mb-0">
              <div class="alert alert-warning">
                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
              </div>
              @livewire('user.deactivate-account')
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
@endsection

