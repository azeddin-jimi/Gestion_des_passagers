@if(app()->getLocale() === 'ar')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet"
        integrity="sha384-dpuaG1suU0eJLzQXUV75stHIF4/8z1ZG19n5YZiY3bYkamKIWLpV89d0qHIAckVFC" crossorigin="anonymous">
@else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@endif
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
<style>
    :root {
        --markoub-teal: #0d9488;
        --markoub-teal-dark: #0f766e;
        --markoub-ink: #134e4a;
    }

    .navbar-markoub {
        background: linear-gradient(90deg, var(--markoub-teal-dark), var(--markoub-teal)) !important;
    }

    .hero-markoub {
        background: linear-gradient(135deg, var(--markoub-ink) 0%, var(--markoub-teal-dark) 45%, #115e59 100%);
        color: #ecfeff;
    }

    body {
        background: linear-gradient(180deg, #f0fdfa 0%, #f8fafc 45%, #f8fafc 100%);
    }

    .btn-markoub {
        --bs-btn-color: #fff;
        --bs-btn-bg: var(--markoub-teal);
        --bs-btn-border-color: var(--markoub-teal);
        --bs-btn-hover-bg: var(--markoub-teal-dark);
        --bs-btn-hover-border-color: var(--markoub-teal-dark);
        --bs-btn-active-bg: var(--markoub-ink);
        --bs-btn-active-border-color: var(--markoub-ink);
    }

    .text-markoub {
        color: var(--markoub-teal-dark) !important;
    }

    .border-markoub {
        border-color: var(--markoub-teal) !important;
    }

    .card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 .5rem 1rem rgba(13, 148, 136, .12) !important;
    }

    .transition-card {
        transition: transform .25s ease, box-shadow .25s ease;
    }

    .hero-search-card {
        border-radius: 1rem;
        overflow: hidden;
    }

    .btn-animated {
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .btn-animated:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(13, 148, 136, .2);
    }

    .fade-in-up {
        animation: fadeInUp .7s ease both;
    }

    .footer-markoub {
        background: #0f172a;
        color: #cbd5e1;
    }

    .footer-markoub a {
        color: #cbd5e1;
        text-decoration: none;
    }

    .footer-markoub a:hover {
        color: #fff;
    }

    .payment-badge {
        border: 1px solid rgba(255, 255, 255, .18);
        border-radius: .6rem;
        padding: .35rem .65rem;
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        background: rgba(255, 255, 255, .05);
        font-size: .8rem;
    }

    .trip-modal-img {
        height: 200px;
        object-fit: cover;
        border-radius: .9rem;
        width: 100%;
    }

    .footer-section {
        color: #334155;
    }

    .footer-section h6 {
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .footer-links li {
        margin-bottom: .65rem;
    }

    .footer-links a {
        color: #475569;
        text-decoration: none;
    }

    .footer-links a:hover {
        color: #0d9488;
    }

    .footer-contact span {
        display: block;
        color: #64748b;
    }

    .footer-payments span {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        margin: .2rem .35rem .2rem 0;
        padding: .45rem .7rem;
        border: 1px solid #e2e8f0;
        border-radius: .8rem;
        background: #f8fafc;
        color: #334155;
        font-size: .88rem;
    }

    .footer-bottom {
        border-top: 1px solid #e2e8f0;
        padding-top: 1.5rem;
        margin-top: 2rem;
    }

    .footer-social a {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 1px solid #cbd5e1;
        color: #475569;
        margin-right: .5rem;
    }

    .footer-social a:hover {
        background: #0d9488;
        color: #fff;
        border-color: transparent;
    }

    .footer-legal-note {
        color: #94a3b8;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 20px, 0);
        }

        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
</style>