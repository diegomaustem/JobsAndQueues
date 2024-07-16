<?php

namespace App\Http\Controllers;

use App\Jobs\paymentConfirmedJob;
use App\Jobs\processingPaymentJob;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

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

        if($processingPayment->status == 'success') {
            $this->paymentConfirmed($payment);
        }
    }

    private function processingPayment($payment)
    {
        try {
            processingPaymentJob::dispatch($payment)->onQueue('processingPayment');
            return (object) ['code' => 200, 'status' => 'success', 'message' => 'Processing payment'];
        } catch(Exception $e) {
            return (object) ['code' => 403, 'status' => 'error', 'message' => 'Error, processing payment'];
        }
    }

    private function paymentConfirmed($payment)
    {
        try {
            paymentConfirmedJob::dispatch($payment)->onQueue('paymentConfirmed')->delay(now()->addSeconds(5));
            return (object) ['code' => 200, 'status' => 'success', 'message' => 'Payment confirmed'];
        } catch(Exception $e) {
            return (object) ['code' => 403, 'status' => 'error', 'message' => 'Error, confirmed payment'];
        }
    }
}
