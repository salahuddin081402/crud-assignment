@extends('layouts.app')
@section('title','Add Product')

@section('content')
<div class="container py-4" style="max-width: 720px;">
  <h2 class="mb-3">Add Product</h2>

  <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" class="needs-validation" >
    @csrf

    <div class="mb-3">
      <label class="form-label">Product ID <span class="text-danger">*</span></label>
      <input type="text" name="product_id" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Name <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="4"></textarea>
    </div>

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Price <span class="text-danger">*</span></label>
        <input type="number" name="price" step="0.01" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control">
      </div>
    </div>

    <div class="mb-3 mt-3">
      <label class="form-label">Image <span class="text-danger">*</span></label>
      <input type="file" name="image" accept="image/*" class="form-control" required>
      <div class="form-text">Recommended: JPG/PNG.</div>
    </div>

    <div class="d-flex gap-2">
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</div>
@endsection
