@extends('layouts.markoub')

@section('title', __('marKoub sahbi') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ __('marKoub sahbi') }}</h1>
                <p class="lead text-muted">
                    {{ __('Le programme marKoub sahbi vous connecte à une communauté de voyageurs au Maroc.') }}</p>
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Pourquoi nous choisir') }}</h2>
                    <p>{{ __('Un service local, des tarifs clairs et une expérience de voyage améliorée.') }}</p>
                </section>
            </div>
        </div>
    </div>
@endsection