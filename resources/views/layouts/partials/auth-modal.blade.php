@guest
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="authModalLabel">{{ __('Se connecter') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Fermer') }}"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills mb-3" id="authTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="pill" data-bs-target="#login-pane" type="button" role="tab">{{ __('Se connecter') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-tab" data-bs-toggle="pill" data-bs-target="#register-pane" type="button" role="tab">{{ __('S\'inscrire') }}</button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="login-pane" role="tabpanel">
                        <form method="POST" action="{{ route('login') }}" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('Mot de passe') }}</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-12 d-flex justify-content-between small">
                                <a href="{{ route('password.request') }}">{{ __('Mot de passe oublié ?') }}</a>
                                <button type="button" class="btn btn-link p-0" data-bs-toggle="pill" data-bs-target="#register-pane">{{ __('S\'inscrire') }}</button>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-markoub w-100 btn-animated">{{ __('Se connecter') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="register-pane" role="tabpanel">
                        <form method="POST" action="{{ route('register') }}" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Prénom') }}</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Nom de famille') }}</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('Email') }}</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">{{ __('Indicatif') }}</label>
                                <select class="form-select">
                                    <option value="+212">🇲🇦 +212</option>
                                    <option value="+33">🇫🇷 +33</option>
                                    <option value="+1">🇺🇸 +1</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">{{ __('Numéro WhatsApp') }}</label>
                                <input type="text" name="whatsapp" class="form-control" placeholder="6XXXXXXXX" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('Mot de passe') }}</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">{{ __('Confirmer mot de passe') }}</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-markoub w-100 btn-animated">{{ __('S\'inscrire') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endguest
