<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationRejected extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $first_name;

    public string $application_type;

    public string $reason;

    public string $update_link;

    /**
     * Create a new message instance.
     */
    public function __construct(
        string $first_name,
        string $application_type,
        string $reason,
        string $update_link
    ) {
        $this->first_name = $first_name;
        $this->application_type = $application_type;
        $this->reason = $reason;
        $this->update_link = $update_link;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'RE: THANK YOU FOR EXPRESSING INTEREST TO JOIN THE ICT ASSOCIATION OF UGANDA',
            from: 'nsengiyumvawilberforce@gmail.com',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.application-rejected'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
