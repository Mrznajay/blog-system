@extends('layouts.app')

@section('content')
<div style="background-color: #f4f6f8; min-height: 100vh; padding: 50px 20px;">
    <div style="max-width: 800px; margin: auto;">

        <div style="background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 8px 20px rgba(0,0,0,0.08);">

            @if($blog->image)
                <img src="{{ asset('storage/'.$blog->image) }}" alt="Blog Image" 
                    style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 12px; margin-bottom: 20px;">
            @endif

            <h1 style="font-size: 2.5rem; font-weight: 700; color: #1f2937; margin-bottom: 10px;">
                {{ $blog->title }}
            </h1>
            <p style="color: #6b7280; font-size: 0.95rem; margin-bottom: 25px;">
                By <strong>{{ $blog->user->name }}</strong> &bull; 
                {{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}
            </p>

            @if($blog->summary)
                <p style="font-size: 1rem; color: #4b5563; font-weight: 500; margin-bottom: 20px;">
                    {{ $blog->summary }}
                </p>
            @endif

            <div style="font-size: 1.1rem; line-height: 1.8; color: #374151;">
                {!! nl2br(e($blog->content)) !!}
            </div>

            <div style="text-align: right; margin-top: 30px;">
                @if(Auth::user()->is_admin)
                    <a href="{{ route('blogs.index') }}"
                    style="display: inline-block; background: #3b82f6; color: #fff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: 0.3s;">
                    &larr; Back to Blogs
                    </a>
                @else
                    <a href="{{ route('blogs.details') }}"
                    style="display: inline-block; background: #3b82f6; color: #fff; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: 0.3s;">
                    &larr; Back to Blogs
                    </a>
                @endif
            </div>

        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        h1 {
            font-size: 2rem;
        }
        div[style*="padding: 30px"] {
            padding: 20px;
        }
    }
    a:hover {
        background-color: #2563eb;
    }
</style>
@endsection
