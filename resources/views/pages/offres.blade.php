@extends('layouts.markoub')

@section('title', __('Offres') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ __('Offres spéciales') }}</h1>
                <p class="lead text-muted">
                    {{ __('Profitez des meilleures offres sur vos trajets et bénéficiez de tarifs avantageux toute l’année.') }}
                </p>
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Nos offres du moment') }}</h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm p-4 h-100">
                                <h3 class="h6">{{ __('Réduction de 15%') }}</h3>
                                <p class="small text-muted">{{ __('Sur les trajets matinaux réservés à l’avance.') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm p-4 h-100">
                                <h3 class="h6">{{ __('Offre fidélité') }}</h3>
                                <p class="small text-muted">
                                    {{ __('Récompensez chaque trajet avec des points convertibles en réduction.') }}</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection