<div class="card mb-4 mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h6 class="mb-0 card-title">DISPLAY IMAGE</h6>
      
    </div>
    <div class="card-body">
      <form action="{{ route('menu.image.store') }}" method="POST" enctype="multipart/form-data" id="product_image" class="dropzone needsclick dz-clickable">
        @csrf
        <div class="dz-message needsclick my-5">
          <p class="fs-6 note needsclick my-2">Drag and drop your image here</p>
          <small class="text-muted d-block fs-6 my-2">or</small>
          <span class="note needsclick btn bg-label-primary d-inline" id="btnBrowse">Browse image</span>
          <input class="note needsclick btn bg-label-primary d-inline" id="btnBrowse" type="hidden" name="product_image" value="{{ $imagename }}">
        </div>
        
      </form>
    </div>
</div>