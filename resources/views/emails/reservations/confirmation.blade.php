<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Confirmation de reservation') }}</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f8fafc; color:#0f172a; margin:0; padding:24px;">
    <div style="max-width:620px; margin:0 auto; background:#ffffff; border-radius:12px; padding:24px; border:1px solid #e2e8f0;">
        <h1 style="font-size:22px; margin-top:0;">{{ __('Reservation confirmee') }}</h1>
        <p>{{ __('Bonjour :name,', ['name' => $reservation->name]) }}</p>
        <p>{{ __('Votre reservation a bien ete enregistree. Voici le recapitulatif:') }}</p>
        <ul style="line-height:1.8;">
            <li><strong>{{ __('Reference') }}:</strong> #{{ $reservation->id }}</li>
            <li><strong>{{ __('Trajet') }}:</strong> {{ $trajet->departure_city }} → {{ $trajet->arrival_city }}</li>
            <li><strong>{{ __('Date') }}:</strong> {{ $trajet->date->format('d/m/Y') }} {{ \Illuminate\Support\Str::substr($trajet->time, 0, 5) }}</li>
            <li><strong>{{ __('Places') }}:</strong> {{ $reservation->seats_reserved }}</li>
            <li><strong>{{ __('Paiement') }}:</strong> {{ $reservation->payment_method }}</li>
        </ul>
        <p>{{ __('Merci pour votre confiance.') }}</p>
    </div>
</body>
</html>
