@extends('layouts.markoub')

@section('title', __('Blog') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <h1 class="mb-4">{{ __('Blog') }}</h1>

                <p class="text-muted">
                    {{ __('Actualités et conseils liés au transport et aux réservations.') }}
                </p>

                <section class="mt-4">

                    <article class="border rounded shadow-sm p-4 mb-3">
                        <h2 class="h6 mb-1">{{ __('Conseils pour voyager malin') }}</h2>
                        <p class="text-muted small mb-0">
                            {{ __('Réserver au bon moment et comparer les trajets.') }}
                        </p>
                    </article>

                    <article class="border rounded shadow-sm p-4 mb-3">
                        <h2 class="h6 mb-1">{{ __('Nouveaux trajets disponibles') }}</h2>
                        <p class="text-muted small mb-0">
                            {{ __('Découvrez les nouvelles destinations ajoutées.') }}
                        </p>
                    </article>

                </section>

            </div>
        </div>
    </div>
@endsection
