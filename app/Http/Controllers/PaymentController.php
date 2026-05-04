<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function show(Reservation $reservation)
    {
        // Ensure the reservation belongs to the authenticated user
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if payment already exists
        if ($reservation->payment) {
            return redirect()->route('reservations.success', $reservation);
        }

        return view('payments.show', [
            'reservation' => $reservation->load('trajet'),
        ]);
    }

    public function process(Request $request, Reservation $reservation): RedirectResponse
    {
        // Ensure the reservation belongs to the authenticated user
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if payment already exists
        if ($reservation->payment) {
            return redirect()->route('reservations.success', $reservation);
        }

        $request->validate([
            'payment_method' => 'required|string',
        ]);

        // Calculate total amount
        $ticketPrice = $reservation->trajet->price * $reservation->seats_reserved;
        $serviceFee = 5.00;
        $totalAmount = $ticketPrice + $serviceFee;

        // Create payment record
        $payment = Payment::create([
            'reservation_id' => $reservation->id,
            'transaction_id' => 'TXN-' . strtoupper(uniqid()),
            'amount' => $totalAmount,
            'currency' => 'MAD',
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        // Simulate payment processing (in real app, this would integrate with payment gateway)
        // For demo purposes, we'll randomly succeed or fail
        $isSuccess = rand(1, 10) > 2; // 80% success rate

        if ($isSuccess) {
            $payment->markAsPaid();
            return redirect()->route('payments.success', $payment);
        } else {
            $payment->markAsFailed();
            return redirect()->route('payments.failed', $payment);
        }
    }

    public function success(Payment $payment): View
    {
        // Ensure the payment belongs to the authenticated user
        if ($payment->reservation->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payments.success', [
            'payment' => $payment->load('reservation.trajet'),
        ]);
    }

    public function failed(Payment $payment): View
    {
        // Ensure the payment belongs to the authenticated user
        if ($payment->reservation->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payments.failed', [
            'payment' => $payment->load('reservation.trajet'),
        ]);
    }
}
