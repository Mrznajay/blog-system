<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BlogMS') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { padding-top: 70px; }
        .card { box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <div class="container mt-4">
        @if(session('success'))
            <div id="success-alert" class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div id="error-alert" class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
<script>
    setTimeout(function() {
        var alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 5000);

    setTimeout(function() {
        var alert = document.getElementById('error-alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 5000);
</script>