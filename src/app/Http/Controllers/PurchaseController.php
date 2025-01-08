<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\Payment;
use App\Models\Sold_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index($item_id)
    {
        $user = Auth::user();
        $item = Item::find($item_id);
        $profile = $user ?? null;
        $paymentId = session('paymentId');
        $paymentMethod = session('newPaymentMethod');

        if(!$paymentMethod && $user && !$user->userPayments->isEmpty()) {
            $paymentMethod = $user->userPayments()->latest('id')->first()->method;
        }

        return view('purchase', compact('item', 'profile', 'paymentId', 'paymentMethod'));
    }

    public function address($item_id)
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('address', compact('user', 'profile', 'item_id'));
    }

    public function updateAddress(Request $request, $item_id)
    {
        $user = Auth::user();
        $form = $request->except('_token');
        $isChanged = false;

        if ($user->profile) {
            foreach ($form as $key => $value) {
                if ($user->profile->$key != $value) {
                    $isChanged = true;
                }
            }

            $user->profile->update($form);
        } else {
            $user->profile()->create($form);
            $isChanged = true;
        }

        if ($isChanged) {
            session()->flash('success', '配送先を変更しました');
        }

        return redirect('/purchase/' . $item_id);
    }

    public function payment($item_id)
    {
        return view('/payment', compact('item_id'));
    }

    public function selectPayment(Request $request, $item_id)
    {
        $paymentId = $request->input('payment');
        $newPaymentMethod = Payment::find($paymentId)->method;

        session([
            'paymentId' => $paymentId,
            'newPaymentMethod' => $newPaymentMethod
        ]);

        return redirect('/purchase/' . $item_id);
    }

    public function decidePurchase(PurchaseRequest $request, $item_id)
    {
        $userId = Auth::id();
        $payment_id = $request->input('payment_id');
        $sold_items = new Sold_item();
        $sold_items->item_id = $item_id;
        $sold_items->user_id = $userId;
        $sold_items->payment_id = $payment_id;
        $sold_items->save();

        return redirect('/item/' . $item_id)->with('success', '購入完了しました');
    }
}
