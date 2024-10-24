<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCertificate extends Mailable
{
    use Queueable, SerializesModels;

    public $firstName;
    public $lastName;
    public $certificatePath;

    public function __construct($firstName, $lastName, $certificatePath)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->certificatePath = $certificatePath;
    }

    public function build()
    {
        return $this->view('emails.certificate')
            ->with([
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
            ])
            ->attach($this->certificatePath);
    }
}
