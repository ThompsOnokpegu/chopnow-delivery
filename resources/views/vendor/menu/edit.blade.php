@extends('vendor.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 order-0"> 
        <div class="card-body">
            <form action="{{ route("menus.update",$menu->id) }}" method="post" enctype="multipart/form-data">
                @method('put') 
                @csrf

            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <div class="d-flex flex-column justify-content-center">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Menu/</span> Edit</h4>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-3">
                  <a href="{{ route('menus.index') }}" class="btn btn-sm btn-outline-secondary">Cancel</a>
                  <button type="submit" class="btn btn-sm btn-primary">Update Product</button>
                </div>
            </div>
            <!--<form action="" method="POST">-->
                <input type="hidden" name="product_image" value="">
                <input type="hidden" name="status" value="inactive">
                <input type="hidden" name="vendor_id" value="{{ $menu->vendor->id }}">
                @include('vendor.menu._form')
                <label class="form-label" for="basic-icon-default-company">Menu Image</label>
                <div class="button-wrapper dropzone needsclick dz-clickable">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Replace Image</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input
                                  type="file"
                                  id="upload"
                                  hidden
                                  name="product_image"
                                /> 
                              </label>
                              <p class="text-muted mb-0">Allowed JPEG,JPG, or PNG. Max size of 300K</p>
                        </div>
                        <div class="col-md-8">
                            <img id="preview" style="border-radius:5px;" src="{{ asset('product-images/'.$menu->product_image) }}" alt="product_image" class="mt-3" width="80"/>
                        </div>
                    </div>
                           
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection