<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.partials.styles')
</head>
<body class="bg-light">
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-5 px-3">
        <div class="mb-4 text-center">
            <a href="{{ route('home') }}" class="text-decoration-none fs-4 fw-bold text-markoub d-inline-flex align-items-center gap-2">
                <i class="bi bi-bus-front-fill"></i>
                <span>{{ config('app.name', 'Laravel') }}</span>
            </a>
        </div>
        <div class="card shadow-sm border-0 w-100" style="max-width: 28rem;">
            <div class="card-body p-4">
                @include('layouts.partials.flash')
                {{ $slot }}
            </div>
        </div>
        <p class="small text-muted mt-3 mb-0">
            <a href="{{ route('home') }}" class="text-muted">{{ __('← Retour à l\'accueil') }}</a>
        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
