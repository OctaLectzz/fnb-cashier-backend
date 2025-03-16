<?php

namespace App\Http\Controllers\Main;

use App\Models\Main\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Main\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Main\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->latest()->get();

        return CategoryResource::collection($categories);
    }

    public function branch(Branch $branch)
    {
        $categories = Category::where('branch_id', $branch->id)->latest()->get();

        return CategoryResource::collection($categories);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:50',
            'description' => 'nullable'
        ]);
        $data['user_id'] = Auth::id();

        // Slug
        $slug = Str::slug($data['name']);
        $data['slug'] = Category::where('slug', $slug)->exists() ? $slug . '-' . Str::random(3) : $slug;

        $category = Category::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Category Created Successfully',
            'data' => new CategoryResource($category)
        ]);
    }

    public function show(Category $category)
    {
        return response()->json([
            'data' => new CategoryResource($category)
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable'
        ]);

        // Slug
        $slug = Str::slug($data['name']);
        $data['slug'] = Category::where('slug', $slug)->exists() ? $slug . '-' . Str::random(3) : $slug;

        $category->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Category Edited Successfully',
            'data' => new CategoryResource($category)
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category Deleted Successfully'
        ]);
    }
}
