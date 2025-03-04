<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Str;
use App\Models\Main\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Main\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable',
            'sku' => 'required|string|max:10|unique:products,sku',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'min_purchase' => 'nullable|integer',
            'selling_price' => 'nullable',
            'purchase_price' => 'required',
            'unit' => 'required|string|max:50',
            'weight' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'status' => 'required|boolean'
        ]);
        $data['min_purchase'] = $data['min_purchase'] ?? 1;

        // Slug
        $slug = Str::slug($data['name']);
        $data['slug'] = Product::where('slug', $slug)->exists() ? $slug . '-' . Str::random(3) : $slug;

        // Image
        if ($request->hasFile('image')) {
            $imageName = 'IMG' . time() . '-' .  $data['slug'] . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('products'), $imageName);
            $data['image'] = $imageName;
        }

        $product = Product::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Product Created Successfully',
            'data' => new ProductResource($product)
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'data' => new ProductResource($product)
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'image' => 'nullable',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sku' => 'required|string|max:10|unique:products,sku,' . $product->id,
            'min_purchase' => 'nullable|integer',
            'selling_price' => 'nullable',
            'purchase_price' => 'required',
            'unit' => 'required|string|max:50',
            'weight' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'status' => 'required|boolean'
        ]);
        $data['min_purchase'] = $data['min_purchase'] ?? 1;

        // Slug
        $slug = Str::slug($data['name']);
        $data['slug'] = Product::where('slug', $slug)->exists() ? $slug . '-' . Str::random(3) : $slug;

        // Image
        if ($request->hasFile('image')) {
            $imageName = 'IMG' . time() . '-' .  $data['slug'] . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('products'), $imageName);
            $data['image'] = $imageName;
        }

        $product->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Product Edited Successfully',
            'data' => new ProductResource($product)
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product Deleted Successfully'
        ]);
    }
}
