@extends('layouts.markoub')

@section('title', __('Centre d\'aide') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ __('Centre d\'aide') }}</h1>
                <p class="lead text-muted">
                    {{ __('Trouvez des réponses aux questions les plus fréquentes et obtenez de l’aide rapidement.') }}</p>
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Questions fréquentes') }}</h2>
                    <ul class="list-group list-group-flush border rounded shadow-sm">
                        <li class="list-group-item">{{ __('Comment réserver un trajet ?') }}</li>
                        <li class="list-group-item">{{ __('Quels sont les moyens de paiement acceptés ?') }}</li>
                        <li class="list-group-item">{{ __('Comment modifier ma réservation ?') }}</li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
@endsection