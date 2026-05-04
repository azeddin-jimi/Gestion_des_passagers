<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Reservation::query()
            ->with(['trajet', 'user', 'payment']);

        // Search filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('trajet', function ($trajetQuery) use ($search) {
                        $trajetQuery->where('departure_city', 'like', "%{$search}%")
                            ->orWhere('arrival_city', 'like', "%{$search}%");
                    });
            });
        }

        // Status filters
        if ($request->filled('status')) {
            switch ($request->status) {
                case 'paid':
                    $query->whereHas('payment', function ($paymentQuery) {
                        $paymentQuery->where('status', 'paid');
                    });
                    break;
                case 'pending':
                    $query->whereHas('payment', function ($paymentQuery) {
                        $paymentQuery->where('status', 'pending');
                    })->orWhereDoesntHave('payment');
                    break;
                case 'failed':
                    $query->whereHas('payment', function ($paymentQuery) {
                        $paymentQuery->where('status', 'failed');
                    });
                    break;
            }
        }

        // Date filter
        if ($request->filled('date')) {
            $query->whereHas('trajet', function ($trajetQuery) use ($request) {
                $trajetQuery->whereDate('date', $request->date);
            });
        }

        $reservations = $query->latest()->paginate(20)->withQueryString();

        return view('admin.reservations.index', compact('reservations'));
    }
}
