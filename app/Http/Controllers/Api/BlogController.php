<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return BlogResource::collection($blogs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $user = $request->user();
        $user->blogs()->create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
            'source_link' => $request->source_link,
        ]);
        return response()->json([
            'message' => 'Blog created successfully'
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        if(!$blog) {
            throw ValidationException::withMessages([
                'blog' => ['Blog not found.'],
            ]);
        }
        return response()->json($blog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        if(!$blog) {
            throw ValidationException::withMessages([
                'blog' => ['Blog not found.'],
            ]);
        }
        $blog->update([
            'category_id'=> $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'source_link' => $request->source_link
        ]);
        return response()->json(['message' => 'Blog updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if(!$blog) {
            throw ValidationException::withMessages([
                'blog' => ['Blog not found.']
            ]);
        }
        $blog->delete();
        return response()->json([
            'message' => 'Blog deleted successfully.'
        ]);
    }
}