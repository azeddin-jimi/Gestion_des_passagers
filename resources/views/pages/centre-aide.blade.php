@extends('layouts.markoub')

@section('title', __('Centre d\'aide') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <h1 class="mb-4">{{ __('Centre d\'aide') }}</h1>

                <p class="text-muted">
                    {{ __('Consultez les réponses aux questions les plus courantes concernant la réservation, le paiement et la gestion de vos trajets.') }}
                </p>

                <section class="mt-4">
                    <ul class="list-group list-group-flush border rounded shadow-sm">

                        <li class="list-group-item">
                            <strong>{{ __('Comment réserver un trajet ?') }}</strong><br>
                            <small class="text-muted">
                                {{ __('Recherchez votre trajet, choisissez l’horaire qui vous convient puis remplissez vos informations avant de confirmer la réservation.') }}
                            </small>
                        </li>

                        <li class="list-group-item">
                            <strong>{{ __('Quels sont les moyens de paiement ?') }}</strong><br>
                            <small class="text-muted">
                                {{ __('Vous pouvez payer en ligne par carte bancaire ou choisir un paiement en espèces via nos partenaires.') }}
                            </small>
                        </li>

                        <li class="list-group-item">
                            <strong>{{ __('Comment modifier ou annuler une réservation ?') }}</strong><br>
                            <small class="text-muted">
                                {{ __('Accédez à votre espace personnel pour gérer votre réservation ou contactez le support en cas de besoin.') }}
                            </small>
                        </li>

                    </ul>
                </section>

            </div>
        </div>
    </div>
@endsection
