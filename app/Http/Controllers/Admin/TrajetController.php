<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrajetRequest;
use App\Http\Requests\Admin\UpdateTrajetRequest;
use App\Models\Trajet;
use App\Support\MoroccanCities;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Throwable;

class TrajetController extends Controller
{
    public function index(): View
    {
        $trajets = Trajet::query()
            ->orderByDesc('date')
            ->orderBy('time')
            ->paginate(15);

        return view('admin.trajets.index', compact('trajets'));
    }

    public function create(): View
    {
        return view('admin.trajets.create', [
            'cities' => MoroccanCities::all(),
        ]);
    }

    public function store(StoreTrajetRequest $request): RedirectResponse
    {
        try {
            Trajet::query()->create($request->validated());
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);

            return back()
                ->withInput()
                ->with('error', __('Impossible de créer le trajet.'));
        }

        return redirect()
            ->route('admin.trajets.index')
            ->with('success', __('Trajet créé avec succès.'));
    }

    public function edit(Trajet $trajet): View
    {
        return view('admin.trajets.edit', [
            'trajet' => $trajet,
            'cities' => MoroccanCities::all(),
        ]);
    }

    public function update(UpdateTrajetRequest $request, Trajet $trajet): RedirectResponse
    {
        try {
            $trajet->update($request->validated());
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);

            return back()
                ->withInput()
                ->with('error', __('Impossible de mettre à jour le trajet.'));
        }

        return redirect()
            ->route('admin.trajets.index')
            ->with('success', __('Trajet mis à jour.'));
    }

    public function destroy(Trajet $trajet): RedirectResponse
    {
        if ($trajet->reservations()->exists()) {
            return redirect()
                ->route('admin.trajets.index')
                ->with('error', __('Impossible de supprimer un trajet qui a des réservations.'));
        }

        try {
            $trajet->delete();
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['exception' => $e]);

            return redirect()
                ->route('admin.trajets.index')
                ->with('error', __('Suppression impossible.'));
        }

        return redirect()
            ->route('admin.trajets.index')
            ->with('success', __('Trajet supprimé.'));
    }
}
