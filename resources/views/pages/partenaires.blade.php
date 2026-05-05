@extends('layouts.markoub')

@section('title', __('Partenaires') . ' — ' . config('app.name'))

@section('content')
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ __('Nos partenaires') }}</h1>
                <p class="lead text-muted">
                    {{ __('Nous travaillons avec des partenaires fiables pour vous offrir des services de transport et de paiement de qualité.') }}
                </p>
                <section class="mt-4">
                    <h2 class="h5 mb-3">{{ __('Partenaires clés') }}</h2>
                    <ul class="list-group list-group-flush border rounded shadow-sm">
                        <li class="list-group-item">Cashplus</li>
                        <li class="list-group-item">Wafacash</li>
                        <li class="list-group-item">Fawatir</li>
                        <li class="list-group-item">Tasshilat</li>
                        <li class="list-group-item">PayPal</li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
@endsection