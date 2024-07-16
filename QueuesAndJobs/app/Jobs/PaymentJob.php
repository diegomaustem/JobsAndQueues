<?php

namespace App\Jobs;

use App\Mail\PaymentSend;
use App\Models\Payment;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Payment $payment
    ) { }

    public function handle()
    {
        Mail::to($this->payment->email)->send(new PaymentSend($this->payment));
    }
}
