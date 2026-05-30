@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label class="form-label" for="name">Name</label>
    <input id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
</div>

<div class="mb-3">
    <label class="form-label" for="category_id">Category</label>
    <select id="category_id" name="category_id" class="form-select">
        <option value="">— Uncategorized —</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label" for="description">Description</label>
    <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label" for="price">Price ($)</label>
        <input id="price" name="price" type="number" step="0.01" min="0" class="form-control"
               value="{{ old('price', $product->price) }}" required>
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label" for="stock">Stock</label>
        <input id="stock" name="stock" type="number" min="0" class="form-control"
               value="{{ old('stock', $product->stock ?? 0) }}" required>
    </div>
    <div class="col-md-4 mb-3 d-flex align-items-end">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                   @checked(old('is_active', $product->is_active ?? true))>
            <label class="form-check-label" for="is_active">Active (visible in shop)</label>
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label" for="image">Image URL</label>
    <input id="image" name="image" type="url" class="form-control" value="{{ old('image', $product->image) }}"
           placeholder="https://...">
    <div class="form-text">Leave blank for a placeholder image.</div>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-dark">{{ $submitLabel }}</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
