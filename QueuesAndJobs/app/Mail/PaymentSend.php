<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentSend extends Mailable
{
    use Queueable, SerializesModels;
    public object $emailData;

    public function __construct($emailData)
    {
        $this->emailData = (object) $emailData;
    }

    public function envelope()
    {
        return new Envelope(
            from: new Address($this->emailData->fromEmail, $this->emailData->dataEmail->description),
            subject: $this->emailData->dataEmail->document
        );
    }

    public function content()
    {
        return new Content(
            view: 'mails.bodyEmail',
        );
    }

    public function attachments()
    {
        return [];
    }
}
