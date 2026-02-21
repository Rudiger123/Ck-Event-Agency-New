<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
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
        .article-title {
            color: #1a1a1a;
            font-size: 24px;
            margin: 20px 0 10px;
        }
        .article-excerpt {
            color: #666;
            font-style: italic;
            margin: 15px 0;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #d4af37;
        }
        .article-content {
            color: #333;
            line-height: 1.8;
            margin: 20px 0;
        }
        .read-more {
            display: inline-block;
            background: #d4af37;
            color: #1a1a1a;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
            font-weight: bold;
        }
        .read-more:hover {
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
            <p>Nouvel Article Publié</p>
        </div>

        <div class="content">
            <p>Bonjour {{ $subscriber->first_name }},</p>

            <p>Un nouvel article a été publié sur notre blog :</p>

            <h2 class="article-title">{{ $article->title }}</h2>

            <div class="article-excerpt">
                {{ $article->excerpt }}
            </div>

            <div class="article-content">
                {{ Illuminate\Support\Str::limit(strip_tags($article->content), 300) }}
            </div>

            <a href="{{ $articleUrl }}" class="read-more">Lire l'article complet</a>

            <hr class="divider">

            <p>Catégorie : <strong>{{ $article->category->name ?? 'Non classé' }}</strong></p>

            @if($article->published_at)
                <p>Publié le : <strong>{{ $article->published_at->format('d/m/Y H:i') }}</strong></p>
            @endif
        </div>

        <div class="footer">
            <p>Vous recevez cet e-mail car vous êtes abonné à notre newsletter.</p>
            <p class="unsubscribe">
                Vous ne souhaitez plus recevoir nos e-mails ?
                <a href="{{ $unsubscribeUrl }}">Se désabonner</a>
