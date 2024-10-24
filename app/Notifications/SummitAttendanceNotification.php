<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SummitAttendanceNotification extends Notification
{
    use Queueable;

    protected $firstName;
    protected $lastName;
    protected $certificatePath;

    public function __construct($firstName, $lastName, $certificatePath)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->certificatePath = $certificatePath;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('National ICT Inaugural Summit Attendance Confirmation')
            ->line('Dear ' . $this->firstName . ' ' . $this->lastName . ',')
            ->line('Thank you for attending the National ICT Inaugural Summit held from 23 to 24 October.')
            ->line('We appreciate your participation and hope you found the event beneficial.')
            ->attach($this->certificatePath);
    }

    public function toArray($notifiable)
    {
        return [
            // Optional data to store in the database
        ];
    }
}
