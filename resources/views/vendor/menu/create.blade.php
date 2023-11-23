@extends('vendor.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 order-0"> 
        <div class="card-body">
            @if($message=session('message'))
                <div class="alert alert-success">
                  {{ $message }}
                </div>
            @endif
            <form action="{{ route("menus.store",$menu->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Menu/</span> Add New</h4>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-3">
                    <a href="{{ route('menus.index') }}" class="btn btn-sm btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-sm btn-primary">Publish Product</button>
                    
                    </div>
                </div>
            <!--<form action="" method="POST">-->
                <input type="hidden" name="vendor_id" value="{{ $vendor_id }}">
                @include('vendor.menu._form')
                <label class="form-label" for="basic-icon-default-company">Menu Image</label>
                <div class="button-wrapper dropzone needsclick dz-clickable">
                    <label for="upload" class="btn btn-primary me-2 mb-4 needsclick dz-clickable" tabindex="0">
                      <span class="d-none d-sm-block">Upload Menu Image</span>
                      <i class="bx bx-upload d-block d-sm-none"></i>
                      <input
                        type="file"
                        id="upload"
                        hidden
                        name="product_image"
                      /> 
                    </label>
                    <p class="text-muted mb-0">Allowed JPEG,JPG, or PNG. Max size of 300K</p>
                    <img id="preview" src="{{ asset('storage/menu-images/'.$menu->product_image) }}" alt="your image" class="mt-3" style="display:none;" width="200"/>    
                    
                </div>
                
                @error('product_image') <div class="error">{{ $message }}</div> @enderror          
            </form>
                 
        </div>
    </div>
</div>
@endsection