<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Demande de Devis</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: #1a1a1a;
            color: #d4af37;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .reference {
            background: #d4af37;
            color: #1a1a1a;
            display: inline-block;
            padding: 5px 15px;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 10px;
        }
        .content {
            padding: 30px;
        }
        .section {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .section h2 {
            margin: 0 0 15px 0;
            color: #1a1a1a;
            font-size: 18px;
            border-bottom: 2px solid #d4af37;
            padding-bottom: 10px;
        }
        .section p {
            margin: 8px 0;
            color: #555;
        }
        .section strong {
            color: #1a1a1a;
        }
        .services-list {
            margin: 10px 0;
            padding-left: 20px;
        }
        .services-list li {
            margin: 5px 0;
            color: #555;
        }
        .message-box {
            background: #f9f7f4;
            padding: 20px;
            border-radius: 6px;
            border-left: 4px solid #d4af37;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #d4af37;
            color: #1a1a1a;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            margin: 20px 0;
        }
        .footer {
            background: #1a1a1a;
            color: #e8d5b7;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💼 Nouvelle Demande de Devis</h1>
            <div class="reference">{{ $quoteRequest->reference }}</div>
        </div>

        <div class="content">
            <p>Une nouvelle demande de devis a été reçue.</p>

            <div class="section">
                <h2>Informations Client</h2>
                <p><strong>Nom :</strong> {{ $quoteRequest->name }}</p>
                <p><strong>Email :</strong> {{ $quoteRequest->email }}</p>
                <p><strong>Téléphone :</strong> {{ $quoteRequest->phone ?? 'Non spécifié' }}</p>
                <p><strong>Entreprise :</strong> {{ $quoteRequest->company ?? 'Non spécifiée' }}</p>
            </div>

            <div class="section">
                <h2>Détails du Projet</h2>
                <p><strong>Services Demandés :</strong></p>
                @if($quoteRequest->service_types && count($quoteRequest->service_types) > 0)
                <ul class="services-list">
                    @foreach($quoteRequest->service_types as $service)
                    <li>{{ $service }}</li>
                    @endforeach
                </ul>
                @else
                <p>Non spécifiés</p>
                @endif

                <p><strong>Date de l'événement :</strong> {{ $quoteRequest->event_date?->format('d/m/Y') ?? 'À définir' }}</p>
                <p><strong>Lieu :</strong> {{ $quoteRequest->location ?? 'Non spécifié' }}</p>
                <p><strong>Budget :</strong> {{ $quoteRequest->budget ?? 'Non spécifié' }}</p>
            </div>

            <h3>Message Client</h3>
            <div class="message-box">
                {{ $quoteRequest->message }}
            </div>

            <p><small><strong>Reçu le :</strong> {{ $quoteRequest->created_at->format('d/m/Y à H:i') }}</small></p>

            <center>
                @php
                    $quoteUrl = url('/admin/quote-requests/' . $quoteRequest->id . '/edit');
                    try {
                        if (Route::has('filament.admin.resources.quote-requests.edit')) {
                            $quoteUrl = route('filament.admin.resources.quote-requests.edit', $quoteRequest);
                        } elseif (Route::has('filament.admin.quote-requests.edit')) {
                            $quoteUrl = route('filament.admin.quote-requests.edit', $quoteRequest);
                        }
                    } catch (\Exception $e) {
                        // Garde l'URL par défaut
                    }
                @endphp
                <a href="{{ $quoteUrl }}" class="button">
                    Répondre avec un Devis
                </a>
            </center>
        </div>

        <div class="footer">
            <p>À bientôt,<br><strong>CK Agency</strong></p>
        </div>
    </div>
</body>
</html>
