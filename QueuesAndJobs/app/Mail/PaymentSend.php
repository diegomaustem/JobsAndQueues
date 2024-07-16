<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentSend extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Payment $payment
    ) { }

    public function envelope()
    {
        return new Envelope(
            from: new Address($this->payment->email, $this->payment->description),
            subject: $this->payment->document
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
