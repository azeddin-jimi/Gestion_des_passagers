@extends('layouts.admin')

@section('title', __('Trajets'))

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-3 mb-4">
        <h1 class="h3 text-secondary mb-0">{{ __('Gestion des trajets') }}</h1>
        <a href="{{ route('admin.trajets.create') }}" class="btn btn-markoub"><i class="bi bi-plus-lg me-1"></i>{{ __('Ajouter') }}</a>
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
                            <th class="text-end">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trajets as $trajet)
                            <tr>
                                <td>{{ $trajet->departure_city }}</td>
                                <td>{{ $trajet->arrival_city }}</td>
                                <td>{{ $trajet->date->format('d/m/Y') }}</td>
                                <td>{{ \Illuminate\Support\Str::substr($trajet->time, 0, 5) }}</td>
                                <td>{{ number_format($trajet->price, 2, ',', ' ') }}</td>
                                <td>{{ $trajet->seats_available }}</td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('admin.trajets.edit', $trajet) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteTrajet{{ $trajet->id }}"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
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
        <div class="modal fade" id="deleteTrajet{{ $trajet->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title h5">{{ __('Supprimer ce trajet ?') }}</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body small text-muted">
                        {{ $trajet->departure_city }} → {{ $trajet->arrival_city }}, {{ $trajet->date->format('d/m/Y') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                        <form action="{{ route('admin.trajets.destroy', $trajet) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Supprimer') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
