<footer class="mt-5 border-top">
    <div class="container py-5">
        <div class="row gy-4">
            <div class="col-6 col-md-3 footer-section">
                <h6>{{ __('Service') }}</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('pages.villes') }}">{{ __('Villes') }}</a></li>
                    <li><a href="{{ route('pages.partenaires') }}">{{ __('Partenaires') }}</a></li>
                    <li><a href="{{ route('pages.parrainage') }}">{{ __('Programme de parrainage') }}</a></li>
                    <li><a href="{{ route('pages.offres') }}">{{ __('Offres') }}</a></li>
                    <li><a href="{{ route('pages.mkhyer') }}">{{ __('M\'Khyer') }}</a></li>
                    <li><a href="{{ route('pages.paiement-en-especes') }}">{{ __('Paiement en espèces') }}</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 footer-section">
                <h6>{{ __('Ressources') }}</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('pages.contactez-nous') }}">{{ __('Contactez-nous') }}</a></li>
                    <li><a href="{{ route('pages.centre-aide') }}">{{ __('Centre d\'aide') }}</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 footer-section">
                <h6>{{ __('Légal') }}</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('pages.confidentialite') }}">{{ __('Confidentialité') }}</a></li>
                    <li><a href="{{ route('pages.conditions') }}">{{ __('Conditions') }}</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 footer-section">
                <h6>{{ __('Notre entreprise') }}</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('pages.carrieres') }}">{{ __('Carrières') }}</a></li>
                    <li><a href="{{ route('pages.blog') }}">{{ __('Blog') }}</a></li>
                </ul>
            </div>

            <div class="col-12 col-md-3 footer-section">
                <h6>{{ __('Contact Info') }}</h6>
                <div class="footer-contact mb-3">
                    <span>{{ __('Téléphone') }}: <a href="tel:0530003000">0655437539</a></span>
                    <span>{{ __('Email') }}: <a
                            href="mailto:gestionpassagers@gmail.com">gestionpassagers@gmail.com</a></span>
                </div>
                <div class="footer-social mb-3">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                    <a href="https://www.linkedin.com/in/azeddine-jimi/" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                </div>
                <div>
                    <h6 class="mb-3">{{ __('Méthodes de paiement') }}</h6>
                    <div class="footer-payments">
                        <span><i class="bi bi-credit-card-fill"></i> Visa</span>
                        <span><i class="bi bi-credit-card-fill"></i> Mastercard</span>
                        <span><i class="bi bi-paypal"></i> PayPal</span>
                        <span><i class="bi bi-credit-card-fill"></i> CMI</span>
                        <span><i class="bi bi-receipt"></i> Fatourati</span>
                        <span><i class="bi bi-cash-stack"></i> Cashplus</span>
                        <span><i class="bi bi-cash-stack"></i> Tasshilat</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-4">
            <p class="mb-2 mb-md-0 footer-legal-note">© {{ date('Y') }} {{ config('app.name') }}.
                {{ __('Tous droits réservés.') }}
            </p>
            <div>
                <a href="{{ route('pages.confidentialite') }}"
                    class="me-3 footer-legal-note">{{ __('Confidentialité') }}</a>
                <a href="{{ route('pages.conditions') }}" class="footer-legal-note">{{ __('Conditions') }}</a>
            </div>
        </div>
    </div>
    <style>
        /* General Footer Styling */
        footer {
            background-color: #008080;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 0.9rem;
        }

        .footer-section h6 {
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            color: #ffffff;
            letter-spacing: 0.5px;
            position: relative;
        }

        /* Dek l-khit sghir li kaykoun t7t l-unwan */
        .footer-section h6::after {
            content: '';
            display: block;
            width: 30px;
            height: 2px;
            background-color: #5105af;
            /* Lawn l-azraq dyal Bootstrap */
            margin-top: 0.5rem;
        }

        /* Links Styling */
        .footer-links li {
            margin-bottom: 0.7rem;
        }

        .footer-links a {
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: #dd0dfd;
            padding-left: 5px;
        }

        /* Contact Info & Social Icons */
        .footer-contact span {
            display: block;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .footer-contact a {
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
        }

        .footer-social a {
            font-size: 1.2rem;
            color: #ffffff;
            margin-right: 15px;
            transition: color 0.3s ease;
        }

        .footer-social a:hover {
            color: #ffd700;
        }

        /* Payment Methods */
        .footer-payments {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-payments span {
            background: #f8f9fa;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            color: #636e72;
            border: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .footer-payments i {
            color: #2d3436;
        }

        /* Bottom Bar */
        .footer-bottom {
            border-top: 1px solid #eee;
        }

        .footer-legal-note {
            font-size: 0.85rem;
            color: #ffffff;
            text-decoration: none;
        }

        .footer-legal-note:hover {
            color: #ffd700;
        }

        /* Responsive adjustment */
        @media (max-width: 768px) {
            .footer-section {
                text-align: center;
            }

            .footer-section h6::after {
                margin: 0.5rem auto 0;
            }

            .footer-social {
                justify-content: center;
                display: flex;
            }

            .footer-payments {
                justify-content: center;
            }
        }
    </style>
</footer>
