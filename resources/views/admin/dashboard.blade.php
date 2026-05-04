@extends('layouts.admin')

@section('title', __('Tableau de bord'))

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-3 mb-4">
        <div>
            <h1 class="h3 text-secondary mb-1">{{ __('Tableau de bord') }}</h1>
            <p class="text-muted small mb-0">{{ __('Vue d\'ensemble des trajets et réservations.') }}</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.trajets.create') }}" class="btn btn-markoub"><i class="bi bi-plus-lg me-1"></i>{{ __('Nouveau trajet') }}</a>
            <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-primary"><i class="bi bi-list-ul me-1"></i>{{ __('Réservations') }}</a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-warning-subtle text-warning p-3"><i class="bi bi-people fs-3"></i></div>
                    <div>
                        <p class="text-muted small mb-0">{{ __('Utilisateurs') }}</p>
                        <p class="h3 mb-0 fw-bold">{{ $usersCount }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-primary-subtle text-primary p-3"><i class="bi bi-map fs-3"></i></div>
                    <div>
                        <p class="text-muted small mb-0">{{ __('Trajets') }}</p>
                        <p class="h3 mb-0 fw-bold">{{ $trajetsCount }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 bg-success-subtle text-success p-3"><i class="bi bi-ticket-perforated fs-3"></i></div>
                    <div>
                        <p class="text-muted small mb-0">{{ __('Réservations') }}</p>
                        <p class="h3 mb-0 fw-bold">{{ $reservationsCount }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h2 class="h5 mb-0">{{ __('Réservations par ligne') }}</h2>
        </div>
        <div class="card-body">
            <canvas id="reservationsByRouteChart" height="90"></canvas>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
            <h2 class="h5 mb-0">{{ __('Réservations récentes') }}</h2>
            <a href="{{ route('admin.reservations.index') }}" class="small">{{ __('Voir tout') }}</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Client') }}</th>
                            <th>{{ __('Trajet') }}</th>
                            <th>{{ __('Places') }}</th>
                            <th>{{ __('Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentReservations as $r)
                            @php($t = $r->trajet)
                            <tr>
                                <td>
                                    <span class="fw-medium">{{ $r->name }}</span>
                                    <div class="small text-muted">{{ $r->phone }}</div>
                                    @if ($r->user)
                                        <div class="small text-muted">{{ $r->user->email }}</div>
                                    @endif
                                </td>
                                <td>{{ $t?->departure_city }} → {{ $t?->arrival_city }}</td>
                                <td><span class="badge bg-secondary">{{ $r->seats_reserved }}</span></td>
                                <td class="small text-muted">{{ $r->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">{{ __('Aucune réservation pour le moment.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script>
        (() => {
            const el = document.getElementById('reservationsByRouteChart');
            if (!el) {
                return;
            }

            const labels = @json($reservationsByRoute->map(fn ($item) => $item->departure_city.' → '.$item->arrival_city)->values());
            const data = @json($reservationsByRoute->pluck('total')->values());

            new Chart(el, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        label: '{{ __('Nombre de réservations') }}',
                        data,
                        borderWidth: 1,
                        borderRadius: 8,
                        backgroundColor: 'rgba(13, 148, 136, 0.7)',
                        borderColor: 'rgba(13, 148, 136, 1)',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        })();
    </script>
@endpush
