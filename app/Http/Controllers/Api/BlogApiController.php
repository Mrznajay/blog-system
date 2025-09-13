<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogApiController extends Controller
{
    public function index()
    {
        try {
            $blogs = Blog::with('user')->get();
            return response()->json($blogs);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch blogs', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $blog = Blog::with('user')->findOrFail($id);
            return response()->json($blog);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Blog not found', 'error' => $e->getMessage()], 404);
        }
    }
}
