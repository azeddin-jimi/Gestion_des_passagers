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

                <p class="lead text-muted">
                    {{ __("Rejoignez notre équipe et contribuez à améliorer l'expérience de réservation de transport interurbain au Maroc.") }}
                </p>

                <p class="text-muted">
                    {{ __("Notre plateforme vise à offrir un service fiable, rapide et sécurisé pour la gestion des trajets et des réservations. Nous recherchons des profils motivés qui souhaitent participer au développement d’une solution innovante dans le domaine du transport.") }}
                </p>

                <!-- Pourquoi nous rejoindre -->
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Pourquoi nous rejoindre ?') }}</h2>
                    <ul class="list-group list-group-flush border rounded shadow-sm">
                        <li class="list-group-item">{{ __('Travailler sur une application web moderne ') }}</li>
                        <li class="list-group-item">{{ __('Participer à l’amélioration de l’expérience utilisateur') }}</li>
                        <li class="list-group-item">{{ __('Développer des compétences en sécurité web et gestion de bases de données') }}</li>
                        <li class="list-group-item">{{ __('Collaborer dans un environnement dynamique et innovant') }}</li>
                    </ul>
                </section>

                <!-- Offres -->
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Offres disponibles') }}</h2>
                    <ul class="list-group list-group-flush border rounded shadow-sm">
                        <li class="list-group-item">
                            <strong>{{ __('Développeur php') }}</strong><br>
                            <small class="text-muted">{{ __('Développement et maintenance de l’application web .') }}</small>
                        </li>

                        <li class="list-group-item">
                            <strong>{{ __('Chargé de relation client') }}</strong><br>
                            <small class="text-muted">{{ __('Support des utilisateurs, gestion des réservations et amélioration du service client.') }}</small>
                        </li>

                        <li class="list-group-item">
                            <strong>{{ __('Responsable marketing digital') }}</strong><br>
                            <small class="text-muted">{{ __('Promotion de la plateforme, gestion des campagnes et amélioration de la visibilité.') }}</small>
                        </li>
                    </ul>
                </section>


            </div>
        </div>
    </div>
@endsection
