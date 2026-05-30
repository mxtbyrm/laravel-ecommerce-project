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
    <input id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
</div>

<div class="mb-3">
    <label class="form-label" for="slug">Slug <span class="text-muted small">(optional)</span></label>
    <input id="slug" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}"
           placeholder="auto-generated from name">
</div>

<div class="mb-3">
    <label class="form-label" for="description">Description</label>
    <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
