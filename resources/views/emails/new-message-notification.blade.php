<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Message de Contact</title>
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
        .info-section {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .info-section h2 {
            margin: 0 0 15px 0;
            color: #1a1a1a;
            font-size: 18px;
            border-bottom: 2px solid #d4af37;
            padding-bottom: 10px;
        }
        .info-section p {
            margin: 8px 0;
            color: #555;
        }
        .info-section strong {
            color: #1a1a1a;
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
            <h1>✉️ Nouveau Message de Contact</h1>
        </div>

        <div class="content">
            <p>Un nouveau message a été reçu via le formulaire de contact.</p>

            <div class="info-section">
                <h2>Informations du Contact</h2>
                <p><strong>Nom :</strong> {{ $msg->name }}</p>
                <p><strong>Email :</strong> {{ $msg->email }}</p>
                @if($msg->phone)
                <p><strong>Téléphone :</strong> {{ $msg->phone }}</p>
                @endif
                <p><strong>Sujet :</strong> {{ $msg->subject }}</p>
                <p><strong>Reçu le :</strong> {{ $msg->created_at->format('d/m/Y à H:i') }}</p>
            </div>

            <h3>Message</h3>
            <div class="message-box">
                {{ $msg->message }}
            </div>

            <center>
                @php
                    $messageUrl = url('/admin/messages/' . $msg->id . '/edit');
                    try {
                        if (Route::has('filament.admin.resources.messages.edit')) {
                            $messageUrl = route('filament.admin.resources.messages.edit', $msg);
                        } elseif (Route::has('filament.admin.messages.edit')) {
                            $messageUrl = route('filament.admin.messages.edit', $msg);
                        }
                    } catch (\Exception $e) {
                        // Garde l'URL par défaut
                    }
                @endphp
                <a href="{{ $messageUrl }}" class="button">
                    Voir dans l'admin
                </a>
            </center>
        </div>

        <div class="footer">
            <p>Merci,<br><strong>CK Agency</strong></p>
        </div>
    </div>
</body>
</html>
