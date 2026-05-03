@extends('layouts.markoub')

@section('title', __('Résultats').' — '.config('app.name'))

@section('content')
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Accueil') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Résultats') }}</li>
        </ol>
    </nav>

    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-lg-between gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1 text-secondary">{{ __('Trajets disponibles') }}</h1>
            <p class="text-muted mb-0">
                <strong>{{ $departure_city }}</strong>
                <i class="bi bi-arrow-right mx-1"></i>
                <strong>{{ $arrival_city }}</strong>
                · {{ \Carbon\Carbon::parse($date)->translatedFormat('l d F Y') }}
            </p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm align-self-start">
            <i class="bi bi-arrow-left me-1"></i>{{ __('Modifier la recherche') }}
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Départ') }}</th>
                            <th>{{ __('Arrivée') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Heure') }}</th>
                            <th>{{ __('Prix') }}</th>
                            <th>{{ __('Places') }}</th>
                            <th class="text-end">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($trajets as $trajet)
                            <tr>
                                <td class="fw-medium">{{ $trajet->departure_city }}</td>
                                <td class="fw-medium">{{ $trajet->arrival_city }}</td>
                                <td>{{ $trajet->date->format('d/m/Y') }}</td>
                                <td>{{ \Illuminate\Support\Str::substr($trajet->time, 0, 5) }}</td>
                                <td>{{ number_format($trajet->price, 2, ',', ' ') }} MAD</td>
                                <td>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">{{ $trajet->seats_available }}</span>
                                </td>
                                <td class="text-end">
                                    @auth
                                        @if (auth()->user()->hasVerifiedEmail() && $trajet->isBookable())
                                            <a href="{{ route('reservations.create', $trajet) }}" class="btn btn-sm btn-markoub">{{ __('Réserver') }}</a>
                                        @elseif (! auth()->user()->hasVerifiedEmail())
                                            <a href="{{ route('verification.notice') }}" class="btn btn-sm btn-outline-secondary">{{ __('Vérifier e-mail') }}</a>
                                        @else
                                            <span class="text-muted small">{{ __('Complet') }}</span>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">{{ __('Connexion') }}</a>
                                    @endauth
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    {{ __('Aucun trajet ne correspond à votre recherche pour cette date.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($trajets->hasPages())
            <div class="card-footer bg-white d-flex justify-content-center">
                {{ $trajets->links() }}
            </div>
        @endif
    </div>
@endsection
