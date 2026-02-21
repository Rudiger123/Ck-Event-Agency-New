<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }}</title>
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
        .content {
            padding: 30px;
        }
        .event-title {
            color: #1a1a1a;
            font-size: 24px;
            margin: 20px 0 10px;
        }
        .event-details {
            color: #666;
            margin: 15px 0;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #d4af37;
        }
        .detail-row {
            margin: 8px 0;
        }
        .detail-label {
            font-weight: bold;
            color: #1a1a1a;
        }
        .event-description {
            color: #333;
            line-height: 1.8;
            margin: 20px 0;
        }
        .view-event {
            display: inline-block;
            background: #d4af37;
            color: #1a1a1a;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
            font-weight: bold;
        }
        .view-event:hover {
            background: #c49a27;
        }
        .divider {
            border: none;
            border-top: 1px solid #e0e0e0;
            margin: 30px 0;
        }
        .footer {
            background: #f4f4f4;
            padding: 20px;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e0e0e0;
        }
        .unsubscribe {
            margin-top: 15px;
        }
        .unsubscribe a {
            color: #d4af37;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
            <p>Nouvel Événement Publié</p>
        </div>

        <div class="content">
            <p>Bonjour {{ $subscriber->first_name }},</p>

            <p>Un nouvel événement a été ajouté à notre portfolio :</p>

            <h2 class="event-title">{{ $event->title }}</h2>

            <div class="event-details">
                @if($event->event_date)
                    <div class="detail-row">
                        <span class="detail-label">📅 Date :</span>
                        {{ $event->event_date->format('d/m/Y') }}
                    </div>
                @endif

                @if($event->location)
                    <div class="detail-row">
                        <span class="detail-label">📍 Lieu :</span>
                        {{ $event->location }}
                    </div>
                @endif

                @if($event->eventType)
                    <div class="detail-row">
                        <span class="detail-label">🎭 Type :</span>
                        {{ $event->eventType->name }}
                    </div>
                @endif

                @if($event->client_name)
                    <div class="detail-row">
                        <span class="detail-label">👤 Client :</span>
                        {{ $event->client_name }}
                    </div>
                @endif
            </div>

            <div class="event-description">
                <p><strong>Résumé :</strong></p>
                {{ Illuminate\Support\Str::limit(strip_tags($event->description), 300) }}
            </div>

            @if($event->testimonial)
                <div style="background: #fef9f0; padding: 15px; border-radius: 4px; margin: 15px 0;">
                    <p><strong>Témoignage Client :</strong></p>
                    <p><em>{{ Illuminate\Support\Str::limit($event->testimonial, 200) }}</em></p>
                </div>
            @endif

            <a href="{{ $eventUrl }}" class="view-event">Voir l'événement complet</a>

            <hr class="divider">

            <p>Nous vous remercions de votre intérêt pour nos événements !</p>
        </div>

        <div class="footer">
            <p>Vous recevez cet e-mail car vous êtes abonné à notre newsletter.</p>
            <p class="unsubscribe">
                Vous ne souhaitez plus recevoir nos e-mails ?
                <a href="{{ $unsubscribeUrl }}">Se désabonner</a>
