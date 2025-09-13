@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">All Blogs</h2>
        <a href="{{ route('blogs.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Create Blog
        </a>
    </div>

    <!-- Blogs Table -->
    <div class="table-responsive" style="background-color: #f4f6f8; min-height: 100vh; padding: 40px 20px;">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published  At</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td class="fw-semibold">{{ $blog->title }}</td>
                    <td>{{ $blog->user->name }}</td>
                    <td>{{ $blog->created_at->format('d M Y') }}</td>
                    <td>{{ ucfirst($blog->status) }}</td>
                    <td class="text-center">
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-info btn-sm me-1">
                            <i class="bi bi-eye"></i> View
                        </a>
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm me-1">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline delete-blog-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">No blogs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
   <div style="margin-top:20px;">
        {{ $blogs->links() }}
    </div>

</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-blog-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit form if confirmed
                    }
                });
            });
        });
    });
</script>

