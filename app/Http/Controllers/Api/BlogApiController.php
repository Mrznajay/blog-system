<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogApiController extends Controller
{
    public function index() {
        return response()->json(Blog::all());
    }

    public function show($id) {
        return response()->json(Blog::findOrFail($id));
    }
}
