@extends('layouts.admin')

@section('title', __('Modifier le trajet'))

@section('content')
    <h1 class="h3 text-secondary mb-4">{{ __('Modifier le trajet') }}</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.trajets.update', $trajet) }}" method="post" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label for="departure_city" class="form-label">{{ __('Départ') }}</label>
                    <select name="departure_city" id="departure_city" class="form-select @error('departure_city') is-invalid @enderror" required>
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" @selected(old('departure_city', $trajet->departure_city) === $city)>{{ $city }}</option>
                        @endforeach
                    </select>
                    @error('departure_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="arrival_city" class="form-label">{{ __('Arrivée') }}</label>
                    <select name="arrival_city" id="arrival_city" class="form-select @error('arrival_city') is-invalid @enderror" required>
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" @selected(old('arrival_city', $trajet->arrival_city) === $city)>{{ $city }}</option>
                        @endforeach
                    </select>
                    @error('arrival_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label">{{ __('Date') }}</label>
                    <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $trajet->date->format('Y-m-d')) }}" required>
                    @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label for="time" class="form-label">{{ __('Heure') }}</label>
                    <input type="time" name="time" id="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time', \Illuminate\Support\Str::substr($trajet->time, 0, 5)) }}" required>
                    @error('time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label for="price" class="form-label">{{ __('Prix (MAD)') }}</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $trajet->price) }}" min="0" required>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label for="seats_available" class="form-label">{{ __('Places disponibles') }}</label>
                    <input type="number" name="seats_available" id="seats_available" class="form-control @error('seats_available') is-invalid @enderror" value="{{ old('seats_available', $trajet->seats_available) }}" min="{{ (int) $trajet->reservations()->sum('seats_reserved') }}" required>
                    @error('seats_available')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">{{ __('Minimum : places déjà réservées (:n).', ['n' => (int) $trajet->reservations()->sum('seats_reserved')]) }}</div>
                </div>
                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-markoub">{{ __('Mettre à jour') }}</button>
                    <a href="{{ route('admin.trajets.index') }}" class="btn btn-outline-secondary">{{ __('Annuler') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
