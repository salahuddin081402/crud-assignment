@extends('layouts.app')
@section('title','Product Details')

@section('content')
<div class="container py-4" style="max-width: 820px;">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Product Details</h2>
    <div class="d-flex gap-2">
      <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">Back to List</a>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <div class="row g-4 align-items-start">
        <div class="col-md-3 text-center">
          @php
            $img = $product->image ? asset('storage/products/'.$product->image) : asset('assets/template/assets/profile.png');
          @endphp
          <img src="{{ $img }}" alt="image" class="img-fluid rounded border" style="max-height:160px">
        </div>
        <div class="col-md-9">
          <table class="table table-sm">
            <tbody>
              <tr>
                <th style="width:180px;">ID</th>
                <td>{{ $product->id }}</td>
              </tr>
              <tr>
                <th>Product ID</th>
                <td><span class="badge text-bg-secondary">{{ $product->product_id }}</span></td>
              </tr>
              <tr>
                <th>Name</th>
                <td class="fw-semibold">{{ $product->name }}</td>
              </tr>
              <tr>
                <th>Description</th>
                <td class="text-muted">{{ $product->description }}</td>
              </tr>
              <tr>
                <th>Price</th>
                <td>৳ {{ number_format((float)$product->price, 2) }}</td>
              </tr>
              <tr>
                <th>Stock</th>
                <td>{{ $product->stock ?? 0 }}</td>
              </tr>
              <tr>
                <th>Created At</th>
                <td>{{ \Illuminate\Support\Carbon::parse($product->created_at)->format('Y-m-d H:i') }}</td>
              </tr>
              <tr>
                <th>Updated At</th>
                <td>{{ \Illuminate\Support\Carbon::parse($product->updated_at)->format('Y-m-d H:i') }}</td>
              </tr>
            </tbody>
          </table>

          <div class="mt-3 d-flex gap-2">
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back to List</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
