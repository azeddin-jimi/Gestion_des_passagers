<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Mail\ReservationConfirmationMail;
use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use RuntimeException;
use Throwable;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::query()
            ->where('user_id', auth()->id())
            ->with('trajet')
            ->latest()
            ->paginate(15);

        return view('reservations.index', compact('reservations'));
    }

    public function create(Trajet $trajet): View|RedirectResponse
    {
        if (! $trajet->isBookable()) {
            return redirect()
                ->route('home')
                ->with('error', __('Ce trajet n\'est plus disponible.'));
        }

        return view('reservations.create', [
            'trajet' => $trajet,
        ]);
    }

    public function store(StoreReservationRequest $request, Trajet $trajet): RedirectResponse
    {
        if (! $trajet->isBookable()) {
            return redirect()
                ->route('home')
                ->with('error', __('Ce trajet n\'est plus disponible.'));
        }

        $validated = $request->validated();
        $reservation = null;

        try {
            $reservation = DB::transaction(function () use ($validated, $trajet, $request): Reservation {
                $locked = Trajet::query()->whereKey($trajet->getKey())->lockForUpdate()->firstOrFail();

                if ($locked->seats_available < $validated['seats_reserved']) {
                    throw new RuntimeException('insufficient_seats');
                }

                $locked->decrement('seats_available', $validated['seats_reserved']);

                $fullName = trim($validated['first_name'].' '.$validated['last_name']);

                return Reservation::query()->create([
                    'user_id' => $request->user()->id,
                    'trajet_id' => $locked->id,
                    'name' => $fullName,
                    'phone' => trim($validated['country_code'].' '.$validated['whatsapp']),
                    'seats_reserved' => $validated['seats_reserved'],
                    'payment_method' => $validated['payment_method'],
                    'discount_code' => $validated['discount_code'] ?? null,
                    'newsletter_opt_in' => (bool) ($validated['newsletter_opt_in'] ?? false),
                    'terms_accepted' => true,
                ]);
            });
        } catch (Throwable $e) {
            if ($e instanceof RuntimeException && $e->getMessage() === 'insufficient_seats') {
                return back()
                    ->withInput()
                    ->with('error', __('Plus assez de places disponibles. Actualisez la page et réessayez.'));
            }

            Log::error($e->getMessage(), ['exception' => $e]);

            return back()
                ->withInput()
                ->with('error', __('Une erreur est survenue lors de la réservation.'));
        }

        if ($reservation) {
            try {
                Mail::to($request->user()->email)->send(new ReservationConfirmationMail($reservation->load('trajet')));
            } catch (Throwable $e) {
                Log::warning('Reservation confirmation mail failed: '.$e->getMessage(), ['exception' => $e]);
            }
        }

        return redirect()
            ->route('reservations.success', $reservation)
            ->with('success', __('Paiement confirme. Reservation enregistree avec succes.'));
    }

    public function success(Reservation $reservation): View
    {
        abort_if($reservation->user_id !== auth()->id(), 403);

        return view('reservations.success', [
            'reservation' => $reservation->load('trajet'),
        ]);
    }
}
