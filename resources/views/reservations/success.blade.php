@extends('layouts.markoub')

@section('title', __('Confirmation') . ' — ' . config('app.name'))

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm text-center p-4 p-lg-5" data-aos="zoom-in">
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                </div>
                <h1 class="h3 mb-2">{{ __('Merci, votre commande est confirmée') }}</h1>
                <p class="text-muted mb-4">
                    {{ __('Un email de confirmation a été envoyé à :email avec les détails de votre réservation.', ['email' => auth()->user()->email]) }}
                </p>

                <div class="bg-light rounded-3 p-3 p-md-4 text-start mb-4">
                    <p class="mb-1 fw-semibold">{{ __('Reference') }} #{{ $reservation->id }}</p>
                    <p class="mb-1">{{ $reservation->trajet->departure_city }} → {{ $reservation->trajet->arrival_city }}
                    </p>
                    <p class="mb-1 text-muted">{{ $reservation->trajet->date->format('d/m/Y') }} -
                        {{ \Illuminate\Support\Str::substr($reservation->trajet->time, 0, 5) }}</p>
                    <p class="mb-0 text-muted">{{ __('Voyageur') }}: {{ $reservation->name }} ({{ $reservation->phone }})
                    </p>
                </div>

                <div class="d-flex justify-content-center gap-2 flex-wrap">
                    <a href="{{ route('reservations.mine') }}"
                        class="btn btn-markoub btn-animated">{{ __('Voir mes reservations') }}</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">{{ __('Retour a l\'accueil') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection