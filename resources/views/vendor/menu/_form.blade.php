<div class="row">
    <div class="col-lg-8">
        <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Menu Title</label>
            <input type="text" name="name" value="{{ old('name',$menu->name) }}" class="form-control" id="basic-default-fullname" placeholder="Pizza" />
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="basic-default-message">Description</label>
            <div class="input-group input-group-merge">
                <span id="basic-icon-default-message2" class="input-group-text">
                    <i class="bx bx-comment"></i>
                </span>
                <textarea
                id="basic-icon-default-message"
                name="description"
                class="form-control"
                placeholder="Describe this menu briefly"
                aria-label="Describe this menu briefly"
                aria-describedby="basic-icon-default-message2"
                >{{ old('description',$menu->description) }}</textarea>
                @error('description') <div class="error">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="basic-icon-default-company">Menu Category</label>
            <div class="input-group">
                <label class="input-group-text" for="category">Categories</label>
                <select class="form-select" id="category" name="category">
                    <option value="">Choose...</option>
                    <option value="Meals" @selected('Meals'==old('category',$menu->category))>Meals</option>
                    <option value="Sides" @selected('Sides'==old('category',$menu->category))>Sides</option>
                    <option value="Drinks" @selected('Drinks'==old('category',$menu->category))>Drinks</option>
                </select>
            </div>
            @error('category') <div class="error">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pricing</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-company">Regular Price</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">₦</span>
                        <input type="text" name="regular_price" value="{{ old('regular_price',$menu->regular_price) }}" class="form-control" placeholder="100" aria-label="Amount (to the nearest Naira)">
                        <span class="input-group-text">.00</span>
                    </div>
                    @error('regular_price') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-icon-default-company">Sale Price</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">₦</span>
                        <input type="text" name="sales_price" value="{{ old('sales_price',$menu->sales_price) }}" class="form-control" placeholder="100" aria-label="Amount (to the nearest Naira)">
                        <span class="input-group-text">.00</span>
                    </div>
                    @error('sales_price') <div class="error">{{ $message }}</div> @enderror
                </div>
            </div>
            {{-- <div class="card-body">
                
                <div class="d-flex justify-content-between mb-2">
                    <label for="payment-terms" class="mb-0">Available to Customers?</label>
                    <label class="switch switch-primary me-0">
                        <div class="form-check form-switch">
                            <input name="status" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        </div>
                    </label>
                </div>
            </div> --}}
        </div>
    </div>
</div>