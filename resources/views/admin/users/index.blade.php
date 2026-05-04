@extends('layouts.admin')

@section('title', __('Utilisateurs'))

@section('content')
    <h1 class="h3 text-secondary mb-4">{{ __('Gestion des utilisateurs') }}</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Nom') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Rôle') }}</th>
                            <th>{{ __('Vérifié') }}</th>
                            <th>{{ __('Inscrit le') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="small text-muted">{{ $user->id }}</td>
                                <td class="fw-medium">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->isAdmin() ? 'bg-dark' : 'bg-secondary' }}">
                                        {{ strtoupper($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    @if ($user->hasVerifiedEmail())
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">{{ __('Oui') }}</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle">{{ __('Non') }}</span>
                                    @endif
                                </td>
                                <td class="small text-muted">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">{{ __('Aucun utilisateur trouvé.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($users->hasPages())
            <div class="card-footer bg-white d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
