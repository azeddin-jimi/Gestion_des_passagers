@extends('layouts.admin')

@section('title', __('Réservations'))

@section('content')
    <h1 class="h3 text-secondary mb-4">{{ __('Toutes les réservations') }}</h1>

    <div class="card border-0 shadow-sm">
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
                                <td>{{ $t?->departure_city }} → {{ $t?->arrival_city }}</td>
                                <td class="small">{{ $t?->date?->format('d/m/Y') }} {{ $t ? \Illuminate\Support\Str::substr($t->time, 0, 5) : '' }}</td>
                                <td><span class="badge bg-primary">{{ $r->seats_reserved }}</span></td>
                                <td class="small text-muted">{{ $r->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">{{ __('Aucune réservation.') }}</td>
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
