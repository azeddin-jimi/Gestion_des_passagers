@extends('layouts.markoub')

@section('title', __('Mes réservations').' — '.config('app.name'))

@section('content')
    <h1 class="h3 text-secondary mb-4">{{ __('Mes réservations') }}</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>{{ __('Trajet') }}</th>
                            <th>{{ __('Date / Heure') }}</th>
                            <th>{{ __('Places') }}</th>
                            <th>{{ __('Contact') }}</th>
                            <th>{{ __('Réservé le') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            @php($t = $reservation->trajet)
                            <tr>
                                <td class="fw-medium">
                                    {{ $t->departure_city }} → {{ $t->arrival_city }}
                                </td>
                                <td>
                                    {{ $t->date->format('d/m/Y') }}
                                    <span class="text-muted">{{ \Illuminate\Support\Str::substr($t->time, 0, 5) }}</span>
                                </td>
                                <td><span class="badge bg-primary-subtle text-primary">{{ $reservation->seats_reserved }}</span></td>
                                <td class="small">{{ $reservation->name }}<br><span class="text-muted">{{ $reservation->phone }}</span></td>
                                <td class="small text-muted">{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    {{ __('Vous n\'avez pas encore de réservation.') }}
                                    <div class="mt-2"><a href="{{ route('home') }}" class="btn btn-sm btn-markoub">{{ __('Rechercher un trajet') }}</a></div>
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
