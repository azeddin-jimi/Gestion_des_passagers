<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('Admin')).' — '.config('app.name')</title>
    @include('layouts.partials.styles')
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row min-vh-100">
            <aside class="col-lg-2 px-0 bg-white border-end shadow-sm">
                <div class="p-3 border-bottom">
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-decoration-none fw-bold text-markoub d-flex align-items-center gap-2">
                        <i class="bi bi-speedometer2"></i>
                        {{ __('Admin') }}
                    </a>
                </div>
                <nav class="nav flex-column p-2 gap-1">
                    <a class="nav-link rounded {{ request()->routeIs('admin.dashboard') ? 'active bg-markoub text-white' : 'text-dark' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid-1x2 me-2"></i>{{ __('Tableau de bord') }}
                    </a>
                    <a class="nav-link rounded {{ request()->routeIs('admin.trajets.*') ? 'active bg-markoub text-white' : 'text-dark' }}"
                        href="{{ route('admin.trajets.index') }}">
                        <i class="bi bi-map me-2"></i>{{ __('Trajets') }}
                    </a>
                    <a class="nav-link rounded {{ request()->routeIs('admin.users.*') ? 'active bg-markoub text-white' : 'text-dark' }}"
                        href="{{ route('admin.users.index') }}">
                        <i class="bi bi-people me-2"></i>{{ __('Utilisateurs') }}
                    </a>
                    <a class="nav-link rounded {{ request()->routeIs('admin.reservations.*') ? 'active bg-markoub text-white' : 'text-dark' }}"
                        href="{{ route('admin.reservations.index') }}">
                        <i class="bi bi-ticket-perforated me-2"></i>{{ __('Réservations') }}
                    </a>
                    <hr class="my-2">
                    <a class="nav-link rounded text-dark" href="{{ route('home') }}">
                        <i class="bi bi-house me-2"></i>{{ __('Site public') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="px-2">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link text-danger text-start w-100 py-2 px-2">
                            <i class="bi bi-box-arrow-right me-2"></i>{{ __('Déconnexion') }}
                        </button>
                    </form>
                </nav>
            </aside>
            <main class="col-lg-10 py-4 px-4">
                @include('layouts.partials.flash')
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.AOS) {
                window.AOS.init({ duration: 600, once: true, easing: 'ease-out' });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>