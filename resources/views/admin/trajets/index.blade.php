@extends('layouts.admin')

@section('title', __('Trajets'))

@section('content')
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-3 mb-4"
    data-aos="fade-right">
    <h1 class="h3 text-secondary mb-0">{{ __('Gestion des trajets') }}</h1>
    <a href="{{ route('admin.trajets.create') }}" class="btn btn-markoub btn-animated">
        <i class="bi bi-plus-lg me-1"></i>{{ __('Ajouter un trajet') }}
    </a>
</div>

<!-- Search and Filters -->
<div class="card border-0 shadow-sm mb-4" data-aos="fade-up">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">{{ __('Ville de départ') }}</label>
                <input type="text" name="departure_city" class="form-control" placeholder="{{ __('Ex: Casablanca') }}"
                    value="{{ request('departure_city') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">{{ __('Ville d\'arrivée') }}</label>
                <input type="text" name="arrival_city" class="form-control" placeholder="{{ __('Ex: Marrakech') }}"
                    value="{{ request('arrival_city') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">{{ __('Statut') }}</label>
                <select name="status" class="form-select">
                    <option value="">{{ __('Tous') }}</option>
                    <option value="available" @selected(request('status') === 'available')>{{ __('Disponibles') }}
                    </option>
                    <option value="full" @selected(request('status') === 'full')>{{ __('Complets') }}</option>
                    <option value="recent" @selected(request('status') === 'recent')>{{ __('Récents') }}</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search me-1"></i>{{ __('Filtrer') }}
                </button>
                <a href="{{ route('admin.trajets.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-1"></i>{{ __('Reset') }}
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Trajets Table -->
<div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="100">
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
                        <th>{{ __('Réservations') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trajets as $trajet)
                    <tr>
                        <td>
                            <span class="badge bg-light text-dark">{{ $trajet->departure_city }}</span>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $trajet->arrival_city }}</span>
                        </td>
                        <td>{{ $trajet->date->format('d/m/Y') }}</td>
                        <td>{{ \Illuminate\Support\Str::substr($trajet->time, 0, 5) }}</td>
                        <td>{{ number_format($trajet->price, 2, ',', ' ') }} MAD</td>
                        <td>
                            <span class="badge bg-{{ $trajet->seats_available > 0 ? 'success' : 'danger' }}">
                                {{ $trajet->seats_available }}
                            </span>
                        </td>
                        <td>
                            @php($reservationCount = $trajet->reservations()->count())
                            <span class="badge bg-{{ $reservationCount > 0 ? 'info' : 'secondary' }}">
                                {{ $reservationCount }}
                            </span>
                        </td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('admin.trajets.edit', $trajet) }}"
                                class="btn btn-sm btn-outline-primary me-1" title="{{ __('Modifier') }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @if($reservationCount > 0)
                                <button type="button" class="btn btn-sm btn-outline-secondary" disabled
                                    title="{{ __('Impossible de supprimer - contient des réservations') }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            @else
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteTrajet{{ $trajet->id }}" title="{{ __('Supprimer') }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            {{ __('Aucun trajet trouvé.') }}
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

@foreach ($trajets as $trajet)
    @if($trajet->reservations()->count() === 0)
        <div class="modal fade" id="deleteTrajet{{ $trajet->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-danger text-white">
                        <h2 class="modal-title h5 mb-0">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ __('Confirmer la suppression') }}
                        </h2>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-2">{{ __('Êtes-vous sûr de vouloir supprimer ce trajet ?') }}</p>
                        <div class="bg-light rounded p-3">
                            <strong>{{ $trajet->departure_city }} → {{ $trajet->arrival_city }}</strong><br>
                            <small class="text-muted">{{ $trajet->date->format('d/m/Y') }} à
                                {{ \Illuminate\Support\Str::substr($trajet->time, 0, 5) }}</small>
                        </div>
                        <div class="alert alert-warning mt-3 mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            {{ __('Cette action est irréversible.') }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                        <form action="{{ route('admin.trajets.destroy', $trajet) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i>{{ __('Supprimer définitivement') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
@endsection