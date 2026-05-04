@extends('layouts.markoub')

@section('title', 'Paiement échoué')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0 rounded-4 text-center p-4">

                <!-- ICON -->
                <div class="mb-3">
                    <i class="bi bi-x-circle-fill text-danger" style="font-size: 4rem;"></i>
                </div>

                <!-- TITLE -->
                <h2 class="text-danger fw-bold mb-2">
                    Paiement échoué
                </h2>

                <p class="text-muted mb-4">
                    Une erreur est survenue lors du traitement de votre paiement.
                </p>

                <!-- DETAILS -->
                <div class="bg-light rounded-3 p-3 text-start mb-4">

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Transaction</span>
                        <strong>{{ $payment->transaction_id ?? '---' }}</strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Montant</span>
                        <strong>{{ number_format($payment->amount ?? 0,2) }} MAD</strong>
                    </div>

                </div>

                <!-- ALERT -->
                <div class="alert alert-warning small">
                    ⚠ Veuillez réessayer ou choisir une autre méthode de paiement.
                </div>

                <!-- BUTTONS -->
                <div class="d-flex gap-2 justify-content-center">

                    <a href="{{ route('payments.show', $payment->reservation) }}" class="btn btn-warning">
                        Réessayer
                    </a>

                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                        Accueil
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>

@endsection
