@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-2">
                    <h4 class="mb-0"><i class="bi bi-person-check me-1"></i>Update User</h4>
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

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name', $user->name) }}" placeholder="Enter user name" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email', $user->email) }}" placeholder="Enter user email" required>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Password <small class="text-muted">(Leave blank to keep current)</small></label>
                            <input type="password" name="password" class="form-control form-control-sm" placeholder="Enter new password">
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold small">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="Confirm new password">
                        </div>

                        <div class="mb-2 form-check">
                            <input type="checkbox" name="is_admin" value="1" class="form-check-input" id="is_admin" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold small" for="is_admin">Admin</label>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="bi bi-pencil-square me-1"></i> Update
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
