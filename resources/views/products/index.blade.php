@extends('layouts.app')
@section('title','Product List')

@section('content')
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Product List</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Product ID</th>
          <th>Name</th>
          <th>Description</th>
          <th class="text-end">Price</th>
          <th class="text-end">Stock</th>
          <th>Image</th>
          <th>Created</th>
          <th>Updated</th>
          <th style="width:220px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $product)
          <tr>
            <td>{{ $product->id }}</td>
            <td><span class="badge text-bg-secondary">{{ $product->product_id }}</span></td>
            <td class="fw-semibold">{{ $product->name }}</td>
            <td class="text-muted">{{ $product->description }}</td>
            <td class="text-end">৳ {{ number_format((float)$product->price, 2) }}</td>
            <td class="text-end">{{ $product->stock ?? 0 }}</td>
            <td>
              <img src="{{ asset('storage/products/'.$product->image) }}" alt="img" width="40" height="40" class="rounded">
            </td>
            <td><small class="text-muted">{{ $product->created_at }}</small></td>
            <td><small class="text-muted">{{ $product->updated_at }}</small></td>
            <td>
              <div class="d-flex gap-2">
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info text-white">View</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                {{-- Delete (uses DELETE route) --}}
                <form action="{{ route('products.destroy', $product->id) }}" method="post" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="10" class="text-center text-muted py-4">No products found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Pagination --}}
  <div class="d-flex justify-content-between align-items-center mt-2">
    <small>
        Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }}
    </small>
    {{ $products->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection
