<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    @include('layouts.partials.styles')
</head>

<body class="bg-light d-flex flex-column min-vh-100">
    @include('layouts.partials.nav-main')

    <main class="flex-grow-1 py-4">
        <div class="container">
            @include('layouts.partials.flash')
            @yield('content')
        </div>
    </main>

    @include('layouts.partials.footer')
    @include('layouts.partials.auth-modal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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

            // Re-open auth modal on validation/login/register errors after redirect
            @if ($errors->any() && old('_auth_tab'))
                const authModalEl = document.getElementById('authModal');
                if (authModalEl) {
                    const authModal = new bootstrap.Modal(authModalEl);
                    authModal.show();

                    const tabSelector = old('_auth_tab') === 'register' ? '#register-tab' : '#login-tab';
                    const tabTriggerEl = document.querySelector(`[data-bs-target="${tabSelector}"]`);

                    if (tabTriggerEl) {
                        const tab = new bootstrap.Tab(tabTriggerEl);
                        tab.show();
                    }
                }
            @endif

            // Smooth scrolling for footer links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    } else {
                        // Scroll to top if target not found
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>