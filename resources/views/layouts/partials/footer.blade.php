<footer class="footer-markoub mt-5 pt-5 pb-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <h6 class="text-white mb-3">{{ __('Service') }}</h6>
                <ul class="list-unstyled small d-grid gap-2">
                    <li><a href="#">{{ __('Villes') }}</a></li>
                    <li><a href="#">{{ __('Partenaires') }}</a></li>
                    <li><a href="#">{{ __('Programme de parrainage') }}</a></li>
                    <li><a href="#">{{ __('Offres') }}</a></li>
                    <li><a href="#">{{ __('Paiement en espèces') }}</a></li>
                </ul>
            </div>
            <div class="col-md-6 col-lg-3">
                <h6 class="text-white mb-3">{{ __('Ressources') }}</h6>
                <ul class="list-unstyled small d-grid gap-2">
                    <li><a href="#">{{ __('Contactez-nous') }}</a></li>
                    <li><a href="#">{{ __('Centre d\'aide') }}</a></li>
                </ul>
                <h6 class="text-white mt-4 mb-3">{{ __('Légal') }}</h6>
                <ul class="list-unstyled small d-grid gap-2">
                    <li><a href="#">{{ __('Confidentialité') }}</a></li>
                    <li><a href="#">{{ __('Conditions') }}</a></li>
                </ul>
            </div>
            <div class="col-md-6 col-lg-3">
                <h6 class="text-white mb-3">{{ __('Notre entreprise') }}</h6>
                <ul class="list-unstyled small d-grid gap-2">
                    <li><a href="#">{{ __('Carrières') }}</a></li>
                    <li><a href="#">{{ __('Blog') }}</a></li>
                    <li><a href="#">{{ __('Presse') }}</a></li>
                    <li><a href="#">{{ __('À propos') }}</a></li>
                </ul>
            </div>
            <div class="col-md-6 col-lg-3">
                <h6 class="text-white mb-3">{{ __('Moyens de Paiement') }}</h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach (['VISA', 'Mastercard', 'PayPal', 'CMI', 'Fatourati', 'Chaabi Cash', 'Tasshilat'] as $payment)
                        <span class="payment-badge">{{ $payment }}</span>
                    @endforeach
                </div>
                <div class="small mt-4">
                    <p class="mb-2"><i class="bi bi-telephone me-2"></i>+212655437539</p>
                    <div class="d-flex gap-3 fs-5">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/azeddine-jimi" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                        <a href="#"><i class="bi bi-tiktok"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <hr class="border-secondary-subtle my-4">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-2 small">
            <span class="text-white fw-semibold"><i class="bi bi-bus-front-fill me-2"></i>{{ config('app.name') }}</span>
            <span>© {{ date('Y') }} {{ config('app.name') }}. {{ __('Tous droits réservés.') }}</span>
        </div>
    </div>
</footer>
