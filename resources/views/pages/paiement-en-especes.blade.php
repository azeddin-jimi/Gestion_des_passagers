@extends('layouts.markoub')

@section('title', __('Paiement en espèces') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ __('Paiement en espèces') }}</h1>
                <p class="lead text-muted">
                    {{ __('Choisissez un point de paiement près de chez vous avec nos partenaires Cashplus, Wafacash, Fawatir et plus.') }}
                </p>
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Agences disponibles') }}</h2>
                    <ul class="list-group list-group-flush border rounded shadow-sm">
                        <li class="list-group-item">Cashplus</li>
                        <li class="list-group-item">Wafacash</li>
                        <li class="list-group-item">Fawatir</li>
                        <li class="list-group-item">Tasshilat</li>
                        <li class="list-group-item">Damane cash</li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
@endsection