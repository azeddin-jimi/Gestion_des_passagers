<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @isset($title) — {{ $title }} @endisset</title>

    @include('layouts.partials.styles')
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    @include('layouts.partials.nav-main')

    @isset($header)
        <header class="bg-white border-bottom shadow-sm">
            <div class="container py-3">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main class="flex-grow-1 py-4">
        <div class="container">
            @include('layouts.partials.flash')
            {{ $slot }}
        </div>
    </main>

    @include('layouts.partials.footer')
    @include('layouts.partials.auth-modal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.AOS) {
                window.AOS.init({ duration: 650, once: true, easing: 'ease-out' });
            }

            document.querySelectorAll('form[data-loading]').forEach((form) => {
                form.addEventListener('submit', () => {
                    const button = form.querySelector('[type="submit"]');
                    const spinner = form.querySelector('[data-spinner]');
                    if (button) {
                        button.setAttribute('disabled', 'disabled');
                    }
                    if (spinner) {
                        spinner.classList.remove('d-none');
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
