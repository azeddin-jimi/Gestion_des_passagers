<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        try {
            DB::transaction(function () use ($validated, $trajet, $request): void {
                $locked = Trajet::query()->whereKey($trajet->getKey())->lockForUpdate()->firstOrFail();

                if ($locked->seats_available < $validated['seats_reserved']) {
                    throw new RuntimeException('insufficient_seats');
                }

                $locked->decrement('seats_available', $validated['seats_reserved']);

                Reservation::query()->create([
                    'user_id' => $request->user()->id,
                    'trajet_id' => $locked->id,
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                    'seats_reserved' => $validated['seats_reserved'],
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

        return redirect()
            ->route('reservations.mine')
            ->with('success', __('Votre réservation a été enregistrée avec succès.'));
    }
}
