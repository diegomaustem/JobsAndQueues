<?php

namespace App\Http\Controllers;

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
        $getUserPayment = User::where('id', $request->id_client)->first();

        if(isset($getUserPayment)) {
            $payment = new Payment();

            $payment->id_client   = $request->id_client;
            $payment->document    = $request->document;
            $payment->name        = $getUserPayment->name;
            $payment->description = $request->description;
            $payment->status      = $request->status;
            $payment->price       = $request->price;

            $defaultEmail = '';

            try {
                Mail::to($defaultEmail, 'Queue Test - Laravel')->send(new PaymentSend(
                    ['fromEmail' => $defaultEmail, 'dataEmail'   => $payment]
                ));
                return ['data' => ['code' => 200, 'message' => 'Send email success!']];
            } catch(Exception $e) {
                return ['data' => ['code' => 403, 'message' => $e]];
            }
        }
    }
}
