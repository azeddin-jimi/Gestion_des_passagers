@extends('layouts.markoub')

@section('title', __('Confidentialité') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ __('Politique de confidentialité') }}</h1>
                <p class="lead text-muted">
                    {{ __('Votre vie privée est importante. Voici comment nous protégeons vos données personnelles.') }}</p>
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Collecte de données') }}</h2>
                    <p>{{ __('Nous recueillons uniquement les informations nécessaires pour gérer vos réservations.') }}</p>
                </section>
            </div>
        </div>
    </div>
@endsection