@extends('layouts.app')

@section('content')
<div class="row" style="background-color: #f4f6f8; min-height: 100vh; padding: 40px 20px;">
    <div class="col-md-6 mb-3">
        <div class="card p-4 text-center">
            <h4>Manage Blogs</h4>
            <p>View, create, edit, and delete blogs</p>
            <a href="{{ route('blogs.index') }}" class="btn btn-primary">Go to Blogs</a>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card p-4 text-center">
            <h4>Manage Users</h4>
            <p>Create, edit, and delete users</p>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Go to Users</a>
        </div>
    </div>
</div>
@endsection
