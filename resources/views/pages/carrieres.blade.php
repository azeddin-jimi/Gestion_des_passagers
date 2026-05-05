@extends('layouts.markoub')

@section('title', __('Carrières') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 mb-4">
                    <h1 class="mb-0">{{ __('Carrières') }}</h1>
                    <span class="badge bg-primary text-white">{{ __('Recrutement') }}</span>
                </div>
                <p class="lead text-muted">{{ __('Rejoignez notre équipe et participez à la croissance de marKoub.') }}</p>
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Offres disponibles') }}</h2>
                    <ul class="list-group list-group-flush border rounded shadow-sm">
                        <li class="list-group-item">{{ __('Chargé de relation client') }}</li>
                        <li class="list-group-item">{{ __('Développeur Laravel') }}</li>
                        <li class="list-group-item">{{ __('Responsable marketing') }}</li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
@endsection