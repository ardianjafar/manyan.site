<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewPostNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public function __construct($post) { $this->post = $post; }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Post Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-post',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('Postingan Baru di Manyan Blog')
                ->markdown('emails.new-post');
    }
}
