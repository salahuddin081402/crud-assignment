<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
           // ->orderByDesc('id')          // newest first
            ->paginate(5);

        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'product_id'  => 'required|string|unique:products,product_id',
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'price'       => 'required|decimal:0,2|min:0',   // exact 2 decimal places, >= 0
            'stock'       => 'nullable|integer|min:0',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $stored   = $req->file('image')->store('products', 'public'); 
        $filename = basename($stored);                                 

        DB::table('products')->insert([
            'product_id'  => $data['product_id'],
            'name'        => $data['name'],
            'description' => $data['description'] ?? null,
            'price'       => $data['price'],
            'stock'       => $data['stock'] ?? null,
            'image'       => $filename,     // store only filename
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product "'.$data['name'].'" inserted successfully!');
    }

    public function edit(int $id)
    {
    $product = DB::table('products')->find($id);
    abort_if(!$product, 404);

    return view('products.edit', compact('product'));
    }


    public function update(Request $request, int $id)
   {
    // load existing row
    $row = DB::table('products')->find($id);
    abort_if(!$row, 404);

    // validate
    $data = $request->validate([
        'product_id'  => 'required|string|unique:products,product_id,'.$id,
        'name'        => 'required|string',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0|decimal:0,2|lt:100000000',
        'stock'       => 'nullable|integer|min:0',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // base fields
    $update = [
        'product_id'  => $data['product_id'],
        'name'        => $data['name'],
        'description' => $data['description'] ?? null,
        'price'       => $data['price'],
        'stock'       => $data['stock'] ?? null,
        'updated_at'  => now(),
    ];

    // if a new image is uploaded → delete old and save new
    if ($request->hasFile('image')) {
        // delete old file if exists
        if (!empty($row->image) && Storage::disk('public')->exists('products/'.$row->image)) {
            Storage::disk('public')->delete('products/'.$row->image);
        }

        // store new file (keep only filename in DB)
        $stored   = $request->file('image')->store('products', 'public'); // "products/xxx.jpg"
        $filename = basename($stored);
        $update['image'] = $filename;
    }

    // update row
    DB::table('products')->where('id', $id)->update($update);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
  }

  public function show(int $id)
  {
    $product = DB::table('products')->find($id);
    abort_if(!$product, 404);

    return view('products.show', compact('product'));
  }

  public function destroy(int $id)
  {
    // fetch row
    $row = DB::table('products')->find($id);
    abort_if(!$row, 404);

    // delete file if present
    if (!empty($row->image) && Storage::disk('public')->exists('products/'.$row->image)) {
        Storage::disk('public')->delete('products/'.$row->image);
    }

    // delete row
    DB::table('products')->where('id', $id)->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted.');
  }
}
