@extends('layouts.markoub')

@section('title', __('Paiement') . ' — ' . config('app.name'))

@section('content')

@php
    $ticketPrice = $reservation->trajet->price * $reservation->seats_reserved;
    $serviceFee = 5.00;
    $totalAmount = $ticketPrice + $serviceFee;
@endphp

<div class="container py-5">
    <div class="row g-4 justify-content-center">

        <!-- FORM -->
        <div class="col-lg-8">
            <form action="{{ route('payments.process', $reservation) }}" method="POST">
                @csrf

                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-white p-4 border-bottom">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-shield-alt text-primary me-2"></i>
                            {{ __('Mode de Paiement') }}
                        </h4>
                        <p class="text-muted small mb-0">
                            {{ __('Choisissez votre méthode de paiement') }}
                        </p>
                    </div>

                    <div class="card-body p-4">

                        <!-- CARD -->
                        <div class="payment-item mb-3">
                            <label class="payment-label p-3 border rounded-3 d-block">
                                <div class="d-flex align-items-center">
                                    <input type="radio" name="payment_method" value="card" class="me-3" checked>
                                    <div>
                                        <strong>Carte Bancaire</strong><br>
                                        <small class="text-muted">Visa / Mastercard</small>
                                    </div>
                                </div>
                            </label>

                            <div id="form_card" class="payment-details p-3 bg-light border rounded-bottom d-none">
                                <input class="form-control mb-2" placeholder="Nom sur carte">
                                <input class="form-control mb-2" placeholder="Numéro de carte">
                                <div class="row">
                                    <div class="col"><input class="form-control" placeholder="MM/YY"></div>
                                    <div class="col"><input class="form-control" placeholder="CVV"></div>
                                </div>
                            </div>
                        </div>

                        <!-- BANK APP -->
                        <div class="payment-item mb-3">
                            <label class="payment-label p-3 border rounded-3 d-block">
                                <div class="d-flex align-items-center">
                                    <input type="radio" name="payment_method" value="bank_app" class="me-3">
                                    <div>
                                        <strong>Application Bancaire</strong><br>
                                        <small class="text-muted">CIH / Attijari / BMCE</small>
                                    </div>
                                </div>
                            </label>

                            <div id="form_bank_app" class="payment-details p-3 bg-light border rounded-bottom d-none">
                                <select class="form-select">
                                    <option>Choisir banque</option>
                                    <option>CIH</option>
                                    <option>Attijari</option>
                                    <option>BMCE</option>
                                </select>
                            </div>
                        </div>

                        <!-- CASH -->
                        <div class="payment-item mb-3">
                            <label class="payment-label p-3 border rounded-3 d-block">
                                <div class="d-flex align-items-center">
                                    <input type="radio" name="payment_method" value="cash" class="me-3">
                                    <div>
                                        <strong>Espèces</strong><br>
                                        <small class="text-muted">Cashplus / Wafacash</small>
                                    </div>
                                </div>
                            </label>

                            <div id="form_cash" class="payment-details p-3 bg-light border rounded-bottom d-none">
                                <input class="form-control" placeholder="Téléphone">
                            </div>
                        </div>

                    </div>
                </div>

                <button class="btn btn-primary w-100 btn-lg">
                    Confirmer {{ number_format($totalAmount,2) }} MAD
                </button>

            </form>
        </div>

        <!-- SUMMARY -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 sticky-top" style="top:20px;">
                <div class="card-body p-4">

                    <h6 class="fw-bold mb-3">Résumé</h6>

                    <div class="d-flex justify-content-between">
                        <span>Trajet</span>
                        <span>{{ $reservation->trajet->departure_city }} → {{ $reservation->trajet->arrival_city }}</span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Places</span>
                        <span>{{ $reservation->seats_reserved }}</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span>Total</span>
                        <strong>{{ number_format($totalAmount,2) }} MAD</strong>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('styles')
<style>
.payment-label{
    cursor:pointer;
    transition:.2s;
}
.payment-label:hover{
    background:#f8f9fa;
    border-color:#2563eb;
}
.payment-label:has(input:checked){
    border-color:#2563eb;
    background:#eef5ff;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const radios = document.querySelectorAll('input[name="payment_method"]');

    function update() {
        document.querySelectorAll('.payment-details')
            .forEach(el => el.classList.add('d-none'));

        const checked = document.querySelector('input[name="payment_method"]:checked');

        if (checked) {
            const box = document.getElementById('form_' + checked.value);
            if (box) box.classList.remove('d-none');
        }
    }

    radios.forEach(r => r.addEventListener('change', update));

    update(); // default
});
</script>
@endpush
