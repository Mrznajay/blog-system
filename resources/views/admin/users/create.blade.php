@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6" style="background-color: #f4f6f8; min-height: 60vh; padding: 40px 20px;">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-2">
                    <h4 class="mb-0"><i class="bi bi-person-plus me-1"></i>Create User</h4>
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

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name') }}" placeholder="Enter user name" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email') }}" placeholder="Enter user email" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Password</label>
                            <input type="password" name="password" class="form-control form-control-sm" placeholder="Enter password" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="Confirm password" required>
                        </div>

                        <div class="mb-2 form-check">
                            <input type="checkbox" name="is_admin" value="1" class="form-check-input" id="is_admin" {{ old('is_admin') ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold small" for="is_admin">Admin</label>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="bi bi-plus-lg me-1"></i> Create
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
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
