<?php

namespace App\Mail;

use App\Models\Applicant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificateSent extends Mailable
{
    use Queueable, SerializesModels;

    public Applicant $applicant;
    public string $certificate;

    /**
     * Create a new message instance.
     */
    public function __construct(
        Applicant $applicant,
        string $certificate
    ) {
        $this->applicant = $applicant;
        $this->certificate = $certificate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'RE: CERTIFICATE OF MEMBERSHIP',
            from: 'nsengiyumvawilberforce@gmail.com',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.certificate-sent',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
           Attachment::fromPath($this->certificate)
        ];
    }
}
