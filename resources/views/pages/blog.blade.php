@extends('layouts.markoub')

@section('title', __('Blog') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ __('Blog') }}</h1>
                <p class="lead text-muted">
                    {{ __('Restez informé des dernières actualités, conseils de voyage et annonces marKoub.') }}</p>
                <section class="mt-4">
                    <article class="border rounded shadow-sm p-4 mb-3">
                        <h2 class="h5">{{ __('Conseils pour voyager malin') }}</h2>
                        <p class="text-muted small">
                            {{ __('Découvrez comment optimiser vos réservations et vos déplacements.') }}</p>
                    </article>
                </section>
            </div>
        </div>
    </div>
@endsection