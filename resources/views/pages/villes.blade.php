@extends('layouts.markoub')

@section('title', 'Villes desservies')

@section('content')
<div class="container py-5">

    <!-- HEADER -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Villes des servies</h1>
        <p class="text-muted">
            Découvrez toutes les villes disponibles sur notre plateforme.
        </p>
    </div>

    <!-- STATS -->
    <div class="row text-center mb-5 g-3">
        <div class="col-md-4">
            <div class="p-3 stat-box">
                <h4 class="fw-bold">{{ count($cities) }}</h4>
                <small>Villes disponibles</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 stat-box">
                <h4 class="fw-bold">{{ $popularRoutes->count() }}</h4>
                <small>Trajets populaires</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 stat-box">
                <h4 class="fw-bold">24/7</h4>
                <small>Service disponible</small>
            </div>
        </div>
    </div>

    <!-- CITIES -->
    <div class="row g-4" id="citiesList">
        @forelse ($cities as $city)
            <div class="col-6 col-md-3 city-card">
                <div class="city-box">
                    {{ $city }}
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                Aucune ville disponible.
            </div>
        @endforelse
    </div>

    <!-- ROUTES -->
    <div class="mt-5">
        <h3 class="fw-bold mb-4">Trajets populaires</h3>

        <div class="row g-4">
            @forelse ($popularRoutes as $route)
                <div class="col-md-4">
                    <div class="route-card p-3">
                        <h6 class="fw-bold">
                            {{ $route->departure_city }} → {{ $route->arrival_city }}
                        </h6>

                        <p class="text-muted small">
                            {{ $route->count }} réservations
                        </p>

                        <a href="{{ route('trajets.search', [
                            'departure_city' => $route->departure_city,
                            'arrival_city' => $route->arrival_city
                        ]) }}"
                        class="btn btn-success btn-sm w-100">
                            Voir les trajets
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    Aucun trajet populaire.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection

<style>
    .city-box{
    background: #fff;
    border-radius: 14px;
    padding: 18px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;

    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.5s forwards;
}

.city-box:hover{
    background: #ecfdf5;
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(16,185,129,0.2);
}

.route-card{
    background: #fff;
    border-radius: 14px;
    transition: 0.3s;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.route-card:hover{
    transform: translateY(-5px);
}

.stat-box{
    background: #f8fafc;
    border-radius: 12px;
    transition: 0.3s;
}

.stat-box:hover{
    transform: translateY(-4px);
    background: #ecfdf5;
}

/* ANIMATION */
@keyframes fadeUp{
    to{
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {

    // stagger animation
    document.querySelectorAll('.city-box').forEach((el, i) => {
        el.style.animationDelay = (i * 80) + "ms";
    });

});
</script>
