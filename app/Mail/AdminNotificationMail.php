<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $subject,
        public string $view,
        public array $data = [],
        public ?string $adminEmail = null
    ) {
        $this->adminEmail = $this->adminEmail ?? config('app.admin_email') ?? 'cynthiankwete@gmail.com';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: [$this->adminEmail],
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: $this->view,
            with: $this->data,
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
