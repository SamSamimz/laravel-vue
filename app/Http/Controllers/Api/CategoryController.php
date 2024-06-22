<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryPostRequest;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryPostRequest $request)
    {
        $user = $request->user();
        $category = Category::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        if($category) {
            return response()->json(['success' => 'Category created successfully']);
        }
        return response()->json(['data' => $request->user()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $category)
    {
        $category = Category::whereSlug($category)->first();
        if ($category) {
            return new CategoryResource($category);
        } else {
            return response()->json(['404' => 'Category not found!'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryPostRequest $request, string $category)
    {
        $category = Category::whereName($category)->first();
        if(!$category) {
            throw ValidationException::withMessages([
                'category' => ['Category not found.'],
            ]);
        }
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return response()->json(['success' => 'Category updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category) {
              throw ValidationException::withMessages([
                'category' => ['Category not found.'],
            ]);
            return response()->json(['messsage' => 'Category not found.']);
        }
        $category->delete();
        return response()->json(['messsage' => 'Category deleted successfully.']);
    }
}