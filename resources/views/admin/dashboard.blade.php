@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
    <style>
        :root {
            --dashboard-teal: #008080;
            --dashboard-soft: rgba(0, 128, 128, 0.08);
            --dashboard-text: #0f172a;
            --dashboard-muted: #6b7280;
        }

        .dashboard-card {
            border-radius: 1.25rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(135deg, rgba(0, 128, 128, 0.95), rgba(0, 128, 128, 0.75));
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 60px rgba(0, 128, 128, 0.18);
        }

        .dashboard-card .icon-circle {
            width: 64px;
            height: 64px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.18);
            color: #ffffff;
            margin-bottom: 1rem;
        }

        .dashboard-stat {
            color: #fff;
        }

        .dashboard-stat small {
            color: rgba(255, 255, 255, 0.85);
        }

        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-chart-card {
            border-radius: 1.25rem;
            overflow: hidden;
            border: 1px solid rgba(0, 128, 128, 0.12);
        }

        .dashboard-chart-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .dashboard-table-card {
            border-radius: 1.25rem;
        }

        .table thead {
            background: rgba(0, 128, 128, 0.06);
        }

        .table tbody tr:hover {
            background: rgba(0, 128, 128, 0.06);
        }

        .animated-title {
            background: linear-gradient(135deg, #004d4d, #009999);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleGlow 2.5s ease-in-out infinite alternate;
        }

        @keyframes titleGlow {
            from {
                text-shadow: 0 0 8px rgba(0, 128, 128, 0.4);
            }

            to {
                text-shadow: 0 0 24px rgba(0, 128, 128, 0.8);
            }
        }
    </style>

    <div class="dashboard-header" data-aos="fade-up">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
            <div>
                <h1 class="h2 fw-bold animated-title mb-2">Tableau de Bord</h1>
                <p class="text-muted mb-0">Une vue claire des trajets les plus populaires et de vos performances.</p>
            </div>
            <div class="badge bg-teal text-white py-2 px-3 rounded-pill" style="background: var(--dashboard-teal);">
                En ligne
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card dashboard-card h-100 p-4">
                <div class="icon-circle mb-3">
                    <i class="bi bi-people fs-3"></i>
                </div>
                <h3 class="fw-bold dashboard-stat">{{ number_format($usersCount) }}</h3>
                <small>Utilisateurs</small>
                <div class="mt-2"><small>Nombre total d'utilisateurs actifs</small></div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="150">
            <div class="card dashboard-card h-100 p-4">
                <div class="icon-circle mb-3">
                    <i class="bi bi-bus-front fs-3"></i>
                </div>
                <h3 class="fw-bold dashboard-stat">{{ number_format($trajetsCount) }}</h3>
                <small>Trajets</small>
                <div class="mt-2"><small>Routes disponibles</small></div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card dashboard-card h-100 p-4">
                <div class="icon-circle mb-3">
                    <i class="bi bi-ticket-perforated fs-3"></i>
                </div>
                <h3 class="fw-bold dashboard-stat">{{ number_format($reservationsCount) }}</h3>
                <small>Réservations</small>
                <div class="mt-2"><small>Réservations enregistrées</small></div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="250">
            <div class="card dashboard-card h-100 p-4">
                <div class="icon-circle mb-3">
                    <i class="bi bi-cash-coin fs-3"></i>
                </div>
                <h3 class="fw-bold dashboard-stat">{{ number_format($totalRevenue, 2) }} DH</h3>
                <small>Revenus</small>
                <div class="mt-2"><small>Montant total payé</small></div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-12" data-aos="fade-up" data-aos-delay="300">
            <div class="card dashboard-chart-card shadow-sm">
                <div class="card-header pt-4 pb-3 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1 fw-bold">Trajets Populaires</h5>
                            <small class="text-muted">Les six itinéraires les plus réservés.</small>
                        </div>
                        <span class="badge rounded-pill text-white" style="background: var(--dashboard-teal);"></span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="chart-container">
                        <canvas id="routesChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12" data-aos="fade-up" data-aos-delay="350">
            <div class="card dashboard-table-card border-0 shadow-sm">
                <div class="card-header bg-white pb-3 px-4 pt-4">
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <h5 class="mb-1 fw-bold">Dernières réservations</h5>
                            <p class="text-muted mb-0">Vue rapide sur les réservations récentes.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Client</th>
                                    <th>Trajet</th>
                                    <th>Date</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentReservations as $reservation)
                                    <tr data-aos="fade-up" data-aos-delay="0">
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div
                                                    class="avatar-sm rounded-circle bg-light d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-person text-muted"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">{{ $reservation->user->name ?? 'N/A' }}</div>
                                                    <small class="text-muted">{{ $reservation->user->email ?? '' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $reservation->trajet->departure_city }} →
                                                {{ $reservation->trajet->arrival_city }}
                                            </div>
                                            <small
                                                class="text-muted">{{ optional($reservation->trajet->departure_date)->format('d/m/Y H:i') }}</small>
                                        </td>
                                        <td>{{ $reservation->created_at->format('d/m/Y H:i') }}</td>                                        <td>
                                            @if($reservation->payment && $reservation->payment->status === 'paid')
                                                <span class="badge bg-success">Payé</span>
                                            @elseif($reservation->payment && $reservation->payment->status === 'failed')
                                                <span class="badge bg-danger">Échoué</span>
                                            @else
                                                <span class="badge bg-secondary">En attente</span>
                                            @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">Aucune réservation récente</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctxBar = document.getElementById('routesChart');
            if (!ctxBar) {
                return;
            }

            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Réservations',
                        data: @json($popularRouteTotals),
                        backgroundColor: '#008080',
                        borderColor: '#005959',
                        borderWidth: 2,
                        borderRadius: 12,
                        maxBarThickness: 40,
                        hoverBackgroundColor: '#006666',
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 1200,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#004d4d',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            callbacks: {
                                label: function (context) {
                                    return context.parsed.y + ' réservations';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: { color: '#334155', maxRotation: 0, minRotation: 0 },
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { color: '#334155' },
                            grid: { color: 'rgba(0, 0, 0, 0.08)' }
                        }
                    }
                }
            });
        });
    </script>
@endpush
