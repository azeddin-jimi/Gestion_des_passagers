@extends('layouts.markoub')

@section('title', __('Réservation').' — '.config('app.name'))

@section('content')
    @php
        $ticketPrice = (float) $trajet->price;
        $serviceFee = 5.00;
        $initialSeats = (int) old('seats_reserved', 1);
        $initialTotal = ($ticketPrice * $initialSeats) + $serviceFee;
    @endphp

    <div class="row g-4">
        <div class="col-lg-8">
            <form action="{{ route('reservations.store', $trajet) }}" method="post" class="d-grid gap-4" data-loading>
                @csrf
                <div class="card border-0 shadow-sm" data-aos="fade-up">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-3">1 {{ __('Contact') }}</h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Prénom') }}</label>
                                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', auth()->user()->first_name) }}" required>
                                @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('Nom de famille') }}</label>
                                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', auth()->user()->last_name) }}" required>
                                @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">{{ __('Indicatif') }}</label>
                                <select name="country_code" class="form-select @error('country_code') is-invalid @enderror" required>
                                    <option value="+212" @selected(old('country_code', '+212') === '+212')>🇲🇦 +212</option>
                                    <option value="+33" @selected(old('country_code') === '+33')>🇫🇷 +33</option>
                                    <option value="+1" @selected(old('country_code') === '+1')>🇺🇸 +1</option>
                                </select>
                                @error('country_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">{{ __('Numéro WhatsApp') }}</label>
                                <input type="text" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp', auth()->user()->whatsapp) }}" placeholder="6XXXXXXXX" required>
                                @error('whatsapp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="80">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-2">2 {{ __('Réservation de siège') }}</h2>
                        <p class="small text-muted">{{ __('Placement libre à bord. Choisissez le nombre de places souhaité.') }}</p>
                        <label class="form-label">{{ __('Nombre de places') }}</label>
                        <input type="number" name="seats_reserved" id="seats_reserved" class="form-control @error('seats_reserved') is-invalid @enderror" value="{{ old('seats_reserved', 1) }}" min="1" max="{{ $trajet->seats_available }}" required>
                        @error('seats_reserved')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        @error('trajet')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="120">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-3">3 {{ __('Paiement') }}</h2>
                        <div class="row g-2">
                            @foreach ([
                                'Carte bancaire',
                                'Application bancaire',
                                'Espèces - Cashplus/Wafacash/Fawatir/Lana cash/Damane cash/MT Cash',
                                'Espèces - Chaabi cash/Tasshilat',
                                'PayPal',
                            ] as $method)
                                <div class="col-12">
                                    <label class="border rounded-3 p-3 w-100 d-flex align-items-center justify-content-between">
                                        <span class="fw-medium">{{ $method }}</span>
                                        <input class="form-check-input" type="radio" name="payment_method" value="{{ $method }}" @checked(old('payment_method') === $method) required>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('payment_method')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                        <div class="mt-3">
                            <label class="form-label">{{ __('Code de réduction') }}</label>
                            <input type="text" name="discount_code" class="form-control @error('discount_code') is-invalid @enderror" value="{{ old('discount_code') }}" placeholder="PROMO2026">
                            @error('discount_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="form-check mb-2">
                            <input class="form-check-input @error('terms_accepted') is-invalid @enderror" type="checkbox" name="terms_accepted" value="1" id="terms_accepted" @checked(old('terms_accepted')) required>
                            <label class="form-check-label small" for="terms_accepted">
                                {{ __('J\'ai lu et j\'accepte les Conditions de vente et la Politique de confidentialité.') }}
                            </label>
                            @error('terms_accepted')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="newsletter_opt_in" value="1" id="newsletter_opt_in" @checked(old('newsletter_opt_in'))>
                            <label class="form-check-label small" for="newsletter_opt_in">
                                {{ __('Je souhaite recevoir la newsletter et les offres promotionnelles.') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-markoub btn-lg btn-animated">
                        {{ __('Payer et confirmer') }}
                        <span class="spinner-border spinner-border-sm ms-2 d-none" data-spinner></span>
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">{{ __('Annuler') }}</a>
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm position-sticky" style="top: 90px;" data-aos="fade-left">
                <div class="card-body p-4">
                    <h3 class="h5 mb-3">{{ __('Récapitulatif') }}</h3>
                    <p class="mb-1">{{ $trajet->departure_city }} → {{ $trajet->arrival_city }}</p>
                    <p class="small text-muted mb-1">{{ $trajet->date->format('d/m/Y') }} {{ \Illuminate\Support\Str::substr($trajet->time, 0, 5) }}</p>
                    <p class="small text-muted">{{ __('Voyageurs') }}: <span id="summarySeats">{{ $initialSeats }}</span></p>

                    <p class="small text-muted mb-3">{{ __('Le code de réduction peut être saisi dans le formulaire de paiement.') }}</p>

                    <div class="small d-grid gap-2">
                        <div class="d-flex justify-content-between">
                            <span>{{ __('Ticket') }}</span>
                            <span id="summaryTicket">{{ number_format($ticketPrice * $initialSeats, 2, ',', ' ') }} DH</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>{{ __('Frais de service') }}</span>
                            <span>{{ number_format($serviceFee, 2, ',', ' ') }} DH</span>
                        </div>
                        <hr class="my-2">
                        <div class="d-flex justify-content-between fw-bold">
                            <span>{{ __('Totale') }}</span>
                            <span id="summaryTotal">{{ number_format($initialTotal, 2, ',', ' ') }} DH</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (() => {
        const seatInput = document.getElementById('seats_reserved');
        const summarySeats = document.getElementById('summarySeats');
        const summaryTicket = document.getElementById('summaryTicket');
        const summaryTotal = document.getElementById('summaryTotal');
        const price = {{ (float) $trajet->price }};
        const fee = 5;

        const update = () => {
            if (!seatInput) return;
            const seats = Math.max(1, parseInt(seatInput.value || '1', 10));
            const ticket = seats * price;
            const total = ticket + fee;
            summarySeats.textContent = seats;
            summaryTicket.textContent = ticket.toFixed(2).replace('.', ',') + ' DH';
            summaryTotal.textContent = total.toFixed(2).replace('.', ',') + ' DH';
        };

        seatInput?.addEventListener('input', update);
        update();
    })();
</script>
@endpush
