
    <div class="mb-3 col-md-6">
        <label for="slug" class="form-label">Shop Link</label>
        <input
          class="form-control"
          type="text"
          id="slug"
          wire:model="slug"
          readonly
          name="slug"
        />
        @error('slug') <div class="error">{{ $message }}</div> @enderror
    </div>

