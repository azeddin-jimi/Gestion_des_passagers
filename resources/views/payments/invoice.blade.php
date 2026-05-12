<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Facture {{ $payment->transaction_id }}</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .invoice {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            animation: slideIn 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }

        .invoice::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #22c55e, #16a34a, #15803d);
            animation: shimmer 2s infinite;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                filter: brightness(1);
            }

            to {
                filter: brightness(1.2);
            }
        }

        .title {
            font-size: 24px;
            color: #1f2937;
            margin: 5px 0;
            font-weight: 600;
        }

        .transaction-id {
            color: #6b7280;
            font-size: 14px;
            margin: 0;
        }

        .status-badge {
            display: inline-block;
            background: linear-gradient(45deg, #22c55e, #16a34a);
            color: white;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: bold;
            margin-top: 15px;
            animation: bounceIn 1s ease-out;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }

            70% {
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .info-section {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
            border-left: 4px solid #00ff51;
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease-out;
        }

        .info-section:nth-child(2) {
            animation-delay: 0.2s;
        }

        .info-section:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .info-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .section-title::before {
            content: '';
            margin-right: 8px;
        }

        .section-title::after {
            content: '';
            margin-left: 8px;
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #13fa41;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .info-row:hover {
            background: rgba(102, 126, 234, 0.05);
            padding-left: 10px;
            border-radius: 5px;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 500;
            color: #6b7280;
            font-size: 14px;
        }

        .info-value {
            font-weight: 600;
            color: #1f2937;
            text-align: right;
        }

        .total-section {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            margin: 30px 0;
            animation: scaleIn 0.8s ease-out;
            box-shadow: 0 8px 25px rgba(34, 197, 94, 0.3);
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .total-label {
            font-size: 14px;
            margin-bottom: 5px;
            opacity: 0.9;
        }

        .total-amount {
            font-size: 32px;
            font-weight: bold;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .thank-you {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-radius: 15px;
            animation: fadeIn 1s ease-out;
            border: 2px solid #0bf50f;
        }

        .thank-you h3 {
            color: #92400e;
            margin: 0 0 10px 0;
            font-size: 18px;
        }

        .thank-you p {
            color: #000000;
            margin: 0;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            font-size: 12px;
            color: #6b7280;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer p {
            margin: 5px 0;
        }

        .footer strong {
            color: #374151;
        }
    </style>

</head>

<body>

    <div class="invoice">

        <div class="header">
            <div class="logo">Gestion des Passagers</div>
            <h1 class="title">Facture de Paiement</h1>
            <p class="transaction-id">ID: {{ $payment->transaction_id }}</p>
            <div class="status-badge">✓ {{ ucfirst($payment->status) }}</div>
        </div>

        <div class="info-section">
            <div class="section-title">Informations Client</div>
            <div class="info-row">
                <span class="info-label">Client</span>
                <span class="info-value">{{ auth()->user()->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value">{{ auth()->user()->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Téléphone</span>
                <span class="info-value">{{ auth()->user()->whatsapp ?? '-' }}</span>
            </div>
        </div>

        <div class="info-section">
            <div class="section-title">Détails du Trajet</div>
            <div class="info-row">
                <span class="info-label">Trajet</span>
                <span class="info-value">{{ $payment->reservation->trajet->departure_city }} ->
                    {{ $payment->reservation->trajet->arrival_city }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Date & Heure</span>
                <span class="info-value">{{ $payment->reservation->trajet->date }} à
                    {{ $payment->reservation->trajet->time }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Places</span>
                <span class="info-value">{{ $payment->reservation->seats_reserved }}</span>
            </div>
        </div>

        <div class="info-section">
            <div class="section-title">Résumé du Paiement</div>
            <div class="info-row">
                <span class="info-label">Prix par place</span>
                <span class="info-value">{{ number_format($payment->reservation->trajet->price, 2) }} MAD</span>
            </div>
            <div class="info-row">
                <span class="info-label">Frais de service</span>
                <span class="info-value">5.00 MAD</span>
            </div>
            <div class="info-row">
                <span class="info-label">Moyen de paiement</span>
                <span class="info-value">{{ ucfirst($payment->payment_method) }}</span>
            </div>
        </div>

        <div class="total-section">
            <div class="total-label">Montant Total Payé</div>
            <div class="total-amount">{{ number_format($payment->amount, 2) }} {{ strtoupper($payment->currency) }}
            </div>
        </div>

        <div class="thank-you">
            <h3>Merci pour votre confiance !</h3>
            <p>Votre réservation est confirmée avec succès.</p>
        </div>

        <div class="footer">
            <p><strong>Gestion des Passagers</strong></p>
            <p>gestionpassagers@gmail.com | 0655437539</p>
            <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
            <p><em>Conservez cette facture comme preuve officielle</em></p>
        </div>
    </div>

</body>

</html>
