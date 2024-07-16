<?php

namespace App\Http\Controllers;

use App\Jobs\PaymentJob;
use App\Mail\PaymentSend;
use App\Models\Payment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $payment = new Payment();
        $payment->id_client   = $request->id_client;
        $payment->document    = $request->document;
        $payment->name        = $request->name;
        $payment->email       = $request->email;
        $payment->description = $request->description;
        $payment->status      = $request->status;
        $payment->price       = $request->price;
        $payment->save();

        $processingPayment = $this->processingPayment($payment);
    }

    private function processingPayment($payment)
    {
        try {
            PaymentJob::dispatch($payment);
            return 'Success';
        } catch(Exception $e) {
            return 'Error';
        }
    }

    private function paymentConfirmed()
    {

    }
}
