<form class="mb-5">
	<div class="form-group row mt-5 mb-3">
		<div class="input-group">
			<input type="file" class="form-control @error('media') is-invalid @enderror"
			       placeholder="Choose file..." id="media-file" type="file" wire:model="media">
			@error('media')
			    <div class="error">{{ $message }}</div>
			@enderror
		</div>
		<small class="text-muted text-center mt-2" wire:loading wire:target="media">
			{{ __('Uploading') }}&hellip;
		</small>
	</div>
	<div class="text-center">
		<button wire:click.prevent="uploadImage" class="btn btn-sm btn-primary w-25">
			<i class="fas fa-check mr-1"></i> {{ __('Optimize') }}
		</button>
	</div>
</form>
{{-- 
<!-- Original Image -->
<div class="card-body">
	<img class="card-img-top" src="{{ $media }}" alt="Original Image" width="400" height="600">
	<h5 class="card-title mt-4 fw-bold">
		Original Image
	</h5>
</div>

<!-- Optimized Image -->
<div class="card-body">
	<img class="card-img-top" src="{{ $optimizedImage }}" alt="Optimized Image" width="400" height="600">
	<h5 class="card-title mt-4 fw-bold">
		Optimized Image
	</h5>
</div> --}}
