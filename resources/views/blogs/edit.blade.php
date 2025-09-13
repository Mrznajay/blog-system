@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-2">
                    <h4 class="mb-0"><i class="bi bi-journal-plus me-1"></i>Update Blog</h4>
                </div>
                <div class="card-body p-3">

                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Title</label>
                            <input type="text" name="title" class="form-control form-control-sm" value="{{ old('title', $blog->title ?? '') }}" placeholder="Enter blog title" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Summary</label>
                            <textarea name="summary" class="form-control form-control-sm" rows="2" placeholder="Write a short summary...">{{ old('summary', $blog->summary ?? '') }}</textarea>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Content</label>
                            <textarea name="content" class="form-control form-control-sm" rows="4" placeholder="Write your content here..." required>{{ old('content', $blog->content ?? '') }}</textarea>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Status</label>
                                <select name="status" class="form-select form-select-sm">
                                    <option value="draft" {{ (old('status', $blog->status ?? '')=='draft')?'selected':'' }}>Draft</option>
                                    <option value="published" {{ (old('status', $blog->status ?? '')=='published')?'selected':'' }}>Published</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Published At</label>
                                <input type="datetime-local" name="published_at" class="form-control form-control-sm" value="{{ isset($blog->published_at) ? $blog->published_at->format('Y-m-d\TH:i') : '' }}">
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Featured Image</label>
                            <input type="file" name="image" class="form-control form-control-sm">
                            @if(isset($blog) && $blog->image)
                                <div class="mt-1">
                                    <img src="{{ asset('storage/'.$blog->image) }}" alt="Blog Image" class="img-thumbnail" style="max-width: 120px;">
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="bi bi-plus-lg me-1"></i> Update
                            </button>
                            <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-x-lg me-1"></i> Back
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
