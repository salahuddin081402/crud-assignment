@extends('layouts.app')
@section('title','Edit Product')

@section('content')
<div class="container py-4" style="max-width: 720px;">
  <h2 class="mb-3">Edit Product</h2>

  {{-- Flash --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Validation errors --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Fix the following:</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Product ID <span class="text-danger">*</span></label>
      <input type="text" name="product_id" value="{{ old('product_id', $product->product_id) }}" class="form-control" required>
      @error('product_id')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Name <span class="text-danger">*</span></label>
      <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
      @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>
      @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Price <span class="text-danger">*</span></label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control" required>
        @error('price')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>
      <div class="col-md-6">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control">
        @error('stock')<div class="text-danger small">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="mb-3 mt-3">
      <label class="form-label">Current Image</label>
      <div class="d-flex align-items-center gap-3">
        @php
          $current = $product->image ? asset('storage/products/'.$product->image) : asset('assets/template/assets/profile.png');
        @endphp
        <img src="{{ $current }}" alt="current" width="64" height="64" class="rounded border">
        <span class="text-muted small">{{ $product->image ?: 'No file' }}</span>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Replace Image (optional)</label>
      <input type="file" name="image" accept="image/*" class="form-control">
      <div class="form-text">Leave empty to keep the current image.</div>
      @error('image')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>

    <div class="d-flex gap-2">
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </form>
</div>
@endsection
