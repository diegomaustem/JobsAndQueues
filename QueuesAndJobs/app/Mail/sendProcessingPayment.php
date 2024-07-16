<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class sendProcessingPayment extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Payment $payment
    ) { }

    public function envelope()
    {
        return new Envelope(
            from: new Address($this->payment->email, $this->payment->description),
            subject: 'Processing Payment'
        );
    }

    public function content()
    {
        return new Content(
            view: 'mails.processingPayment',
        );
    }

    public function attachments()
    {
        return [];
    }
}
