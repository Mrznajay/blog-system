<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {  
            if (!Gate::allows('manage-users')) {
                abort(403, 'This action is unauthorized.');
            }
            return $next($request);
        })->except(['details', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            $blogs = Blog::with('user')->latest()->simplePaginate(5);
            return view('blogs.index', compact('blogs'));
        } catch (\Exception $e) {
            \Log::error('Error fetching blogs: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to fetch blogs. Please try again later.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
             $request->validate([
                'title' => 'required|string|max:255',
                'summary' => 'nullable|string',
                'content' => 'required|string',
                'status' => 'required|in:draft,published',
                'image' => 'nullable|image|max:2048',
            ]);

            $data = $request->only('title', 'summary', 'content', 'status', 'published_at');
            $data['user_id'] = Auth::id();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('blogs', 'public');
            }

            Blog::create($data);

            return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
        }

        catch (\Exception $e) {
            \Log::error('Error creating blog: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Unable to create blog. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        try {
            return view('blogs.show', compact('blog'));
        } catch (\Throwable $th) {
            return redirect()->route('blogs.index')->with('error', 'Something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'summary' => 'nullable|string',
                'content' => 'required|string',
                'status' => 'required|in:draft,published',
                'image' => 'nullable|image|max:2048',
            ]);

            $data = $request->only('title', 'summary', 'content', 'status', 'published_at');

            if ($request->hasFile('image')) {
                if ($blog->image) {
                    Storage::disk('public')->delete($blog->image);
                }
                $data['image'] = $request->file('image')->store('blogs', 'public');
            }

            $blog->update($data);

            return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
        } catch (\Throwable $e) {
            \Log::error('Error update blog: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Unable to update blog. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        try {
            $blog->delete();
            return redirect()->route('blogs.index')->with('success', 'Blog deleted');
        } catch (\Throwable $e) {
            \Log::error('Error delete blog: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Unable to delete blog. Please try again later.');
        }
    }

    public function details()
    {
        try {
            $blogs = Blog::with('user')->latest()->simplePaginate(5);
            return view('blogs.details', compact('blogs'));
        } catch (\Exception $e) {
            \Log::error('Error fetching blog details: ' . $e->getMessage());
            return redirect()->route('blogs.index')->with('error', 'Blog not found or unable to fetch details.');
        }
    }
}
