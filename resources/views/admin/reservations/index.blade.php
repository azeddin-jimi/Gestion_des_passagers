@extends('layouts.admin')

@section('title', __('Réservations'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-right">
    <h1 class="h3 text-secondary mb-0">{{ __('Gestion des réservations') }}</h1>
    <span class="badge bg-primary fs-6">{{ $reservations->total() }} {{ __('réservations') }}</span>
</div>

<!-- Search and Filters -->
<div class="card border-0 shadow-sm mb-4" data-aos="fade-up">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">{{ __('Rechercher') }}</label>
                <input type="text" name="search" class="form-control" placeholder="{{ __('Nom, email, ville...') }}"
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">{{ __('Statut paiement') }}</label>
                <select name="status" class="form-select">
                    <option value="">{{ __('Tous') }}</option>
                    <option value="paid" @selected(request('status') === 'paid')>{{ __('Payées') }}</option>
                    <option value="pending" @selected(request('status') === 'pending')>{{ __('En attente') }}</option>
                    <option value="failed" @selected(request('status') === 'failed')>{{ __('Échouées') }}</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">{{ __('Date du trajet') }}</label>
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search me-1"></i>{{ __('Filtrer') }}
                </button>
                <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-1"></i>{{ __('Reset') }}
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Reservations Table -->
<div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="100">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>{{ __('Client') }}</th>
                        <th>{{ __('Trajet') }}</th>
                        <th>{{ __('Départ') }}</th>
                        <th>{{ __('Places') }}</th>
                        <th>{{ __('Paiement') }}</th>
                        <th>{{ __('Créée le') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservations as $r)
                    @php($t = $r->trajet)
                    <tr>
                        <td class="text-muted small">{{ $r->id }}</td>
                        <td>
                            <span class="fw-medium">{{ $r->name }}</span>
                            <div class="small text-muted">{{ $r->phone }}</div>
                            @if ($r->user)
                                <div class="small"><i class="bi bi-person-badge me-1"></i>{{ $r->user->email }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $t?->departure_city }} →
                                {{ $t?->arrival_city }}</span>
                        </td>
                        <td class="small">
                            {{ $t?->date?->format('d/m/Y') }}
                            <div class="text-muted">{{ $t ? \Illuminate\Support\Str::substr($t->time, 0, 5) : '' }}
                            </div>
                        </td>
                        <td><span class="badge bg-primary">{{ $r->seats_reserved }}</span></td>
                        <td>
                            @if($r->payment)
                                @if($r->payment->isPaid())
                                    <span class="badge bg-success"><i
                                            class="bi bi-check-circle me-1"></i>{{ __('Payé') }}</span>
                                @elseif($r->payment->isFailed())
                                    <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>{{ __('Échec') }}</span>
                                @else
                                    <span class="badge bg-warning"><i class="bi bi-clock me-1"></i>{{ __('En attente') }}</span>
                                @endif
                            @else
                                <span class="badge bg-secondary"><i
                                        class="bi bi-dash-circle me-1"></i>{{ __('Non initié') }}</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $r->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            {{ __('Aucune réservation trouvée.') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($reservations->hasPages())
        <div class="card-footer bg-white d-flex justify-content-center">
            {{ $reservations->links() }}
        </div>
    @endif
</div>
@endsection