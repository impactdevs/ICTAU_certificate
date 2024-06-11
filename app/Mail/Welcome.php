<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Applicant;

class Welcome extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Applicant $applicant;

    /**
     * Create a new message instance.
     */
    public function __construct(
        Applicant $applicant,
    ) {
        $this->applicant = $applicant;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'RE: ELECTION AS A ' . $this->applicant->application_type . ' MEMBER OF THE ICT ASSOCIATION OF UGANDA
',
from: 'info@ippu.org',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.welcome'
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
