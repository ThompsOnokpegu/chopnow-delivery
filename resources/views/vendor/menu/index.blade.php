@extends('vendor.layouts.main')

@section('content')
<!-- Product List Widget -->

<!-- Product List Table -->

  <div class="card">
    <div class="card-header">
      <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        
        {{-- <div class="d-flex flex-column justify-content-center">
          <h5 class="card-title">Filter</h5>
        </div> --}}
        <div class="d-flex align-content-center flex-wrap gap-3">
          <a href="{{ route('menus.create') }}" class="btn btn-md btn-outline-primary"><i class="bx bx-plus-circle me-1"></i>New Menu</a>
        </div>
      </div>
      
      <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
        @if(session()->has('permission'))
          <div class="alert alert-danger">
            {{ session('permission') }}
          </div>
        @endif
        {{-- <div class="col-md-4 product_status"><select id="ProductStatus" class="form-select text-capitalize"><option value="">Status</option><option value="Published">Published</option><option value="Inactive">Inactive</option></select></div> --}}
        {{-- <div class="col-md-4 product_category"><select id="ProductCategory" class="form-select text-capitalize"><option value="">Category</option><option value="Household">Household</option><option value="Office">Office</option><option value="Electronics">Electronics</option><option value="Shoes">Shoes</option><option value="Accessories">Accessories</option><option value="Game">Game</option></select></div> --}}
        
      </div>
      
      <div class="table-responsive text-nowrap">
        <table class="table card-table">
          <thead>
            <tr>
              <th>Menu</th>
              <th>Category</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @include('vendor.menu._menus-table')
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  @endsection