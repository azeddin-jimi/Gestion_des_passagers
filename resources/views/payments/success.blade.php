@extends('layouts.markoub')

@section('title', 'Paiement réussi')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0 rounded-4 text-center p-4">

                <!-- ICON -->
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                </div>

                <!-- TITLE -->
                <h2 class="text-success fw-bold mb-2">
                    Paiement confirmé
                </h2>

                <p class="text-muted mb-4">
                    Votre réservation a été validée avec succès.
                </p>

                <!-- DETAILS -->
                <div class="bg-light rounded-3 p-3 text-start mb-4">

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Transaction</span>
                        <strong>{{ $payment->transaction_id ?? '---' }}</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Montant</span>
                        <strong>{{ number_format($payment->amount ?? 0,2) }} MAD</strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Trajet</span>
                        <strong>
                            {{ $payment->reservation->trajet->departure_city ?? '---' }}
                            →
                            {{ $payment->reservation->trajet->arrival_city ?? '---' }}
                        </strong>
                    </div>

                </div>

                <!-- ALERT -->
                <div class="alert alert-success small">
                    ✔ Paiement sécurisé — Merci pour votre confiance
                </div>

                <!-- BUTTONS -->
                <div class="d-flex gap-2 justify-content-center">

                    <a href="{{ route('reservations.mine') }}" class="btn btn-primary">
                        Voir mes réservations
                    </a>

                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                        Accueil
                    </a>

                </div>

            </div>

        </div>
    </div>
</div>
</div>

