@extends('layouts.markoub')

@section('title', __('Programme de parrainage') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ __('Programme de parrainage') }}</h1>
                <p class="lead text-muted">
                    {{ __('Invitez vos amis et gagnez des avantages sur vos prochains trajets. C’est simple, rapide et sécurisé.') }}
                </p>
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Comment ça marche') }}</h2>
                    <ol class="list-group list-group-numbered border rounded shadow-sm">
                        <li class="list-group-item">{{ __('Partagez votre lien de parrainage.') }}</li>
                        <li class="list-group-item">{{ __('Votre ami réserve un trajet.') }}</li>
                        <li class="list-group-item">{{ __('Vous recevez des crédits ou des réductions.') }}</li>
                    </ol>
                </section>
            </div>
        </div>
    </div>
@endsection