@extends('layouts.markoub')

@section('title', config('app.name').' — '. __('Réservez votre trajet'))

@section('content')
    <section class="hero-markoub rounded-4 p-4 p-lg-5 mb-5 shadow fade-in-up" data-aos="fade-up">
        <div class="row align-items-center g-4">
            <div class="col-lg-5">
                <p class="text-uppercase small fw-semibold opacity-75 mb-2">{{ __('Transport interurbain') }}</p>
                <h1 class="display-5 fw-bold mb-3">{{ __('Où allez-vous ?') }}</h1>
                <p class="lead opacity-90 mb-0">{{ __('Trouvez un trajet en quelques secondes avec une recherche simple et rapide.') }}</p>
            </div>
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg hero-search-card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card-body p-4 bg-white text-dark rounded-3">
                        <h2 class="h5 fw-semibold mb-3 text-secondary">{{ __('Rechercher un trajet') }}</h2>
                        <form action="{{ route('trajets.search') }}" method="get" class="row g-3" data-loading>
                            <div class="col-md-6">
                                <label for="departure_city" class="form-label">{{ __('Départ') }}</label>
                                <select name="departure_city" id="departure_city" class="form-select @error('departure_city') is-invalid @enderror" required>
                                    <option value="">{{ __('Ville de départ') }}</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city }}" @selected(old('departure_city', request('departure_city')) === $city)>{{ $city }}</option>
                                    @endforeach
                                </select>
                                @error('departure_city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="arrival_city" class="form-label">{{ __('Arrivée') }}</label>
                                <select name="arrival_city" id="arrival_city" class="form-select @error('arrival_city') is-invalid @enderror" required>
                                    <option value="">{{ __('Ville d\'arrivée') }}</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city }}" @selected(old('arrival_city', request('arrival_city')) === $city)>{{ $city }}</option>
                                    @endforeach
                                </select>
                                @error('arrival_city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="date" class="form-label">{{ __('Date') }}</label>
                                <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror"
                                    value="{{ old('date', request('date')) }}"
                                    min="{{ now()->format('Y-m-d') }}">
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">{{ __('Optionnel') }}</div>
                            </div>
                            <div class="col-12 col-lg-6 d-grid align-self-end">
                                <button type="submit" class="btn btn-markoub btn-lg btn-animated">
                                    <i class="bi bi-search me-2"></i>{{ __('Rechercher') }}
                                    <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true" data-spinner></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($featuredTrajets->isNotEmpty())
        <section class="mb-2" data-aos="fade-up" data-aos-delay="120">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                <h2 class="h4 mb-0 text-secondary">{{ __('Prochains départs') }}</h2>
                <span class="badge bg-white text-markoub border border-markoub">{{ __('Places disponibles') }}</span>
            </div>
            <div class="row g-4">
                @foreach ($featuredTrajets as $trajet)
                    <div class="col-md-6 col-xl-4">
                        <div class="card border-0 shadow-sm h-100 transition-card card-hover">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong class="text-markoub">{{ $trajet->departure_city }}</strong>
                                        <i class="bi bi-arrow-right mx-1 text-muted"></i>
                                        <strong class="text-markoub">{{ $trajet->arrival_city }}</strong>
                                    </div>
                                    <span class="badge text-bg-light text-dark border">{{ $trajet->seats_available }} {{ __('pl.') }}</span>
                                </div>
                                <p class="small text-muted mb-2">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $trajet->date->translatedFormat('d M Y') }}
                                    <span class="mx-2">·</span>
                                    <i class="bi bi-clock me-1"></i>{{ \Illuminate\Support\Str::substr($trajet->time, 0, 5) }}
                                </p>
                                <p class="h5 mb-3">{{ number_format($trajet->price, 2, ',', ' ') }} <span class="small text-muted">MAD</span></p>
                                @auth
                                    @if (auth()->user()->hasVerifiedEmail() && $trajet->isBookable())
                                        <a href="{{ route('reservations.create', $trajet) }}" class="btn btn-outline-primary btn-sm w-100">{{ __('Réserver') }}</a>
                                    @elseif (! auth()->user()->hasVerifiedEmail())
                                        <a href="{{ route('verification.notice') }}" class="btn btn-outline-secondary btn-sm w-100">{{ __('Vérifier l\'e-mail pour réserver') }}</a>
                                    @else
                                        <button class="btn btn-outline-secondary btn-sm w-100" disabled>{{ __('Complet') }}</button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-markoub btn-sm w-100">{{ __('Connexion pour réserver') }}</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection
