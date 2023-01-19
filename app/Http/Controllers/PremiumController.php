<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mollie\Laravel\Facades\Mollie;

class PremiumController extends Controller
{
    public function buy()
    {

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "1.00" // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "description" => "Premium Account",
            "method" => 'creditcard',
            "redirectUrl" => route('dashboard'),
            "webhookUrl" => route('webhooks.mollie'),
            "metadata" => [
                "person_id" => Auth::user()->person->id
            ],
        ]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function webhook(Request $request)
    {
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);

        if ($payment->isPaid())
        {
            $personId = $payment->metadata->person_id;
            $person = Person::find($personId);
            $person->is_premium = true;
            $person->save();
        }
    }
}
