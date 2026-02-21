<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Commentaire</title>
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
        .comment-box {
            background: #f9f7f4;
            padding: 20px;
            border-radius: 6px;
            border-left: 4px solid #d4af37;
            margin: 20px 0;
            font-style: italic;
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
        .status-approved { color: #4CAF50; }
        .status-pending { color: #FF9800; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💬 Nouveau Commentaire sur un Article</h1>
        </div>

        <div class="content">
            <p>Un nouveau commentaire a été reçu sur l'article <strong>{{ $comment->article->title ?? 'Inconnu' }}</strong>.</p>

            <div class="info-section">
                <h2>Informations</h2>
                <p><strong>Auteur :</strong> {{ $comment->name }}</p>
                <p><strong>Email :</strong> {{ $comment->email }}</p>
                <p><strong>Date :</strong> {{ $comment->created_at->format('d/m/Y à H:i') }}</p>
                <p>
                    <strong>Statut :</strong>
                    @if($comment->is_visible)
                        <span class="status-approved">✅ Visible</span>
                    @else
                        <span class="status-pending">❌ En attente de modération</span>
                    @endif
                </p>
            </div>

            <h3>Commentaire</h3>
            <div class="comment-box">
                {{ $comment->content }}
            </div>

            <center>
                @php
                    $commentUrl = url('/admin/comments/' . $comment->id . '/edit');
                    try {
                        if (Route::has('filament.admin.resources.comments.edit')) {
                            $commentUrl = route('filament.admin.resources.comments.edit', $comment);
                        } elseif (Route::has('filament.admin.comments.edit')) {
                            $commentUrl = route('filament.admin.comments.edit', $comment);
                        }
                    } catch (\Exception $e) {
                        // Garde l'URL par défaut
                    }
                @endphp
                <a href="{{ $commentUrl }}" class="button">
                    @if(!$comment->is_visible)
                        Modérer le Commentaire
                    @else
                        Voir dans l'admin
                    @endif
                </a>
            </center>
        </div>

        <div class="footer">
            <p>À bientôt,<br><strong>CK Agency</strong></p>
        </div>
    </div>
</body>
</html>
