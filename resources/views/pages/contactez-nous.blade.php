@extends('layouts.markoub')

@section('title', __('Contactez-nous') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <h1 class="mb-4">{{ __('Contactez-nous') }}</h1>

                <p class="text-muted">
                    {{ __('Notre équipe est disponible pour répondre à vos questions et vous aider dans vos réservations.') }}
                </p>

                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Coordonnées') }}</h2>

                    <div class="border rounded shadow-sm p-4">
                        <p class="mb-2">
                            <strong>{{ __('Téléphone') }}:</strong><br>
                            06 55 43 75 39
                        </p>

                        <p class="mb-0">
                            <strong>{{ __('Email') }}:</strong><br><a href="mailto:gestionpassagers@gmail.com">
                            gestionpassagers@gmail.com</a>
                        </p>
                    </div>
                </section>

            </div>
        </div>
    </div>
@endsection
