@extends('layouts.markoub')

@section('title', __('Contactez-nous') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ __('Contactez-nous') }}</h1>
                <p class="lead text-muted">
                    {{ __('Notre équipe est à votre écoute pour toute question ou assistance concernant vos trajets.') }}
                </p>
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Coordonnées') }}</h2>
                    <p>{{ __('Téléphone') }}: 05 3000 3000</p>
                    <p>{{ __('Email') }}: support@gestionpassagers.ma</p>
                </section>
            </div>
        </div>
    </div>
@endsection