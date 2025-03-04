<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Item;

class StripeController extends Controller
{
    public function cardPayment($item_id)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $item = Item::find($item_id);

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', ['item_id' => $item_id]),
            'cancel_url' => route('purchase.cancel', ['item_id' => $item_id]),
        ]);

        return redirect($session->url);
    }

    public function conveniencePayment($item_id)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $item = Item::find($item_id);

        $session = StripeSession::create([
            'payment_method_types' => ['konbini'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', ['item_id' => $item_id]),
            'cancel_url' => route('purchase.cancel', ['item_id' => $item_id]),
        ]);

        return redirect($session->url);
    }
}
