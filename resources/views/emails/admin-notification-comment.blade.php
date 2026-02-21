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
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .accent-bar {
            height: 5px;
            background: linear-gradient(90deg, #d4af37 0%, #f4e5c3 100%);
        }
        .header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            color: #d4af37;
            padding: 30px;
            text-align: center;
            border-bottom: 2px solid #d4af37;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .header p {
            margin: 8px 0 0 0;
            color: #e8d5b7;
            font-size: 14px;
        }
        .content {
            padding: 40px;
        }
        .info-block {
            margin-bottom: 30px;
            border-left: 4px solid #d4af37;
            padding-left: 20px;
        }
        .info-block h2 {
            margin: 0 0 15px 0;
            color: #1a1a1a;
            font-size: 18px;
        }
        .info-block p {
            margin: 5px 0;
            color: #555;
        }
        .info-block strong {
            color: #1a1a1a;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            color: white;
            border-radius: 3px;
            font-size: 12px;
            font-weight: 600;
        }
        .comment-box {
            margin-bottom: 30px;
        }
        .comment-box h3 {
            margin: 0 0 15px 0;
            color: #1a1a1a;
        }
        .comment-content {
            background: #f9f7f4;
            padding: 20px;
            border-radius: 6px;
            border-left: 3px solid #d4af37;
            color: #2d2d2d;
            line-height: 1.6;
            font-style: italic;
        }
        .cta-button {
            text-align: center;
            margin: 40px 0;
        }
        .cta-button a {
            display: inline-block;
            padding: 15px 40px;
            background: linear-gradient(135deg, #d4af37 0%, #f4e5c3 100%);
            color: #1a1a1a;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }
        .footer {
            background: #1a1a1a;
            color: #d4af37;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            border-top: 2px solid #d4af37;
        }
        .footer p {
            margin: 0;
            color: #e8d5b7;
        }
        a { color: #d4af37; text-decoration: none; }
    </style>
</head>
<body>
    <div style="padding: 40px 20px;">
        <div class="container">
            <div class="accent-bar"></div>

            <div class="header">
                <h1>💬 Nouveau Commentaire</h1>
                <p>En attente de modération</p>
            </div>

            <div class="content">
                <div class="info-block">
                    <h2>👤 Auteur</h2>
                    <p><strong>Nom:</strong> {{ $comment->name }}</p>
                    <p><strong>Email:</strong> <a href="mailto:{{ $comment->email }}">{{ $comment->email }}</a></p>
                    <p><strong>Article:</strong>
                        @if($comment->article)
                            <span style="color: #d4af37;">{{ $comment->article->title }}</span>
                        @elseif($comment->event)
                            <span style="color: #d4af37;">{{ $comment->event->title }}</span>
                        @else
                            Non disponible
                        @endif
                    </p>
                    <p><strong>Date:</strong> {{ $comment->created_at->format('d/m/Y à H:i') }}</p>
                    <p style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #e8d5b7;">
                        <strong>Statut:</strong>
                        <span class="status-badge" style="background: {{ $comment->is_approved ? '#4CAF50' : '#FF9800' }};">
                            {{ $comment->is_approved ? 'Approuvé' : 'En attente' }}
                        </span>
                    </p>
                </div>

                <div class="comment-box">
                    <h3>📝 Commentaire</h3>
                    <div class="comment-content">
                        {{ $comment->content }}
                    </div>
                </div>

                <div class="cta-button">
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
                    <a href="{{ $commentUrl }}">
                        👁️ MODÉRER DANS L'ADMINISTRATION
                    </a>
                </div>
            </div>

            <div class="footer">
                <p>Ce message a été déclenché automatiquement par le système de notifications.</p>
            </div>
        </div>
    </div>
</body>
</html>
