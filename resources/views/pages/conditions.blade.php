@extends('layouts.markoub')

@section('title', __('Conditions') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ __('Conditions générales') }}</h1>
                <p class="lead text-muted">{{ __('Consultez les conditions d’utilisation et les règles applicables à l’utilisation de notre service.') }}</p>
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Utilisation du service') }}</h2>
                    <p>{{ __('En utilisant Gestion des Passagers, vous acceptez nos conditions générales et nos règles de conduite.') }}</p>
                </section>
            </div>
        </div>
    </div>
@endsection
