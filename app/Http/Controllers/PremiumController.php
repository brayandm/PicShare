<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mollie\Laravel\Facades\Mollie;

class PremiumController extends Controller
{
    public function buy()
    {

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "10.00" // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Order #12345",
            "method" => 'creditcard',
            "redirectUrl" => route('dashboard'),
            "webhookUrl" => route('webhooks.mollie'),
            "metadata" => [
                "order_id" => "123",
            ],
        ]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success()
    {
        return view('premium.success');
    }

    public function webhook(Request $request)
    {
        Log::error($request);
    }
}
