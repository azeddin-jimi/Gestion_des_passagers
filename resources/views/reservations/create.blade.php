@extends('layouts.markoub')

@section('title', __('Réservation').' — '.config('app.name'))

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Accueil') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Réservation') }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h1 class="h4 text-secondary mb-3">{{ __('Votre trajet') }}</h1>
                    <p class="mb-1 fs-5 fw-semibold text-markoub">
                        {{ $trajet->departure_city }}
                        <i class="bi bi-arrow-right mx-1 text-muted"></i>
                        {{ $trajet->arrival_city }}
                    </p>
                    <ul class="list-unstyled small text-muted mb-0 mt-3">
                        <li class="mb-2"><i class="bi bi-calendar3 me-2"></i>{{ $trajet->date->translatedFormat('l d F Y') }}</li>
                        <li class="mb-2"><i class="bi bi-clock me-2"></i>{{ \Illuminate\Support\Str::substr($trajet->time, 0, 5) }}</li>
                        <li class="mb-2"><i class="bi bi-currency-exchange me-2"></i>{{ number_format($trajet->price, 2, ',', ' ') }} MAD / {{ __('place') }}</li>
                        <li
                            x-data="{
                                seats: {{ $trajet->seats_available }},
                                bookable: {{ $trajet->isBookable() ? 'true' : 'false' }},
                                async refresh() {
                                    try {
                                        const r = await fetch(@json(route('trajets.availability', $trajet)), { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
                                        const j = await r.json();
                                        this.seats = j.seats_available;
                                        this.bookable = j.bookable;
                                    } catch (e) {}
                                }
                            }"
                            x-init="setInterval(() => refresh(), 8000)"
                        >
                            <span class="fw-medium text-dark">{{ __('Places restantes') }} :</span>
                            <span class="badge bg-success-subtle text-success ms-1" x-text="seats"></span>
                            <span class="small text-muted ms-2">({{ __('mise à jour automatique') }})</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h5 mb-3">{{ __('Coordonnées & places') }}</h2>
                    <form action="{{ route('reservations.store', $trajet) }}" method="post" class="row g-3" novalidate>
                        @csrf
                        <div class="col-md-6">
                            <label for="name" class="form-label">{{ __('Nom complet') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="form-control @error('name') is-invalid @enderror" required maxlength="255">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">{{ __('Téléphone') }} <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" required maxlength="50" placeholder="+212 6 12 34 56 78">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="seats_reserved" class="form-label">{{ __('Nombre de places') }} <span class="text-danger">*</span></label>
                            <input type="number" name="seats_reserved" id="seats_reserved" value="{{ old('seats_reserved', 1) }}" class="form-control @error('seats_reserved') is-invalid @enderror" min="1" max="{{ $trajet->seats_available }}" required>
                            @error('seats_reserved')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('trajet')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 d-flex flex-wrap gap-2 pt-2">
                            <button type="submit" class="btn btn-markoub">{{ __('Confirmer la réservation') }}</button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">{{ __('Retour') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
