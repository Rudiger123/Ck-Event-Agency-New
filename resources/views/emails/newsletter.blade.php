<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $newsletter->subject }}</title>
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
        .newsletter-content {
            color: #333;
            line-height: 1.8;
        }
        .newsletter-content h1,
        .newsletter-content h2,
        .newsletter-content h3 {
            color: #1a1a1a;
        }
        .divider {
            border: none;
            border-top: 1px solid #e0e0e0;
            margin: 30px 0;
        }
        .unsubscribe {
            text-align: center;
            margin: 30px 0;
        }
        .button-secondary {
            display: inline-block;
            padding: 10px 20px;
            background: #666;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .footer {
            background: #1a1a1a;
            color: #e8d5b7;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #1a1a1a;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $newsletter->subject }}</h1>
        </div>

        <div class="content">
            <div class="greeting">
                @if($subscriber->first_name)
                    Bonjour {{ $subscriber->first_name }},
                @else
                    Bonjour,
                @endif
            </div>

            <div class="newsletter-content">
                {!! $newsletter->content !!}
            </div>

            <hr class="divider">

            <p style="font-size: 12px; color: #666; text-align: center;">
                Vous recevez cet email car vous êtes abonné à notre newsletter.
                Vous pouvez vous désabonner en cliquant sur le lien ci-dessous.
            </p>

            <div class="unsubscribe">
                <a href="{{ $unsubscribeUrl }}" class="button-secondary">
                    Se désabonner
                </a>
            </div>
        </div>

        <div class="footer">
            <p>Cordialement,<br><strong>CK Agency</strong></p>
        </div>
    </div>
</body>
</html>
