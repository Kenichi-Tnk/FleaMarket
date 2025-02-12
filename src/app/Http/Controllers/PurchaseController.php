<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\Payment;
use App\Models\SoldItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index($item_id)
    {
        $user = Auth::user();
        $item = Item::find($item_id);
        $payments = Payment::all();
        $paymentId = session('paymentId');
        $paymentMethod = session('paymentMethod', '支払いが未設定です');

        return view('purchase', compact('item', 'user', 'payments', 'paymentId', 'paymentMethod'));
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

        foreach ($form as $key => $value) {
            if ($user->$key !== $value) {
                $isChanged = true;
            }
        }

        $user->update($form);

        if ($isChanged){
            session()->flash('success', '配送先を変更しました');
        }

        return redirect('/purchase/' . $item_id);
    }

    public function payment($item_id)
    {
        $payments = Payment::all();
        return view('payment', compact('item_id', 'payments'));
    }

    public function selectPayment(Request $request, $item_id)
    {
        $paymentId = $request->input('payment');
        $payment = Payment::find($paymentId);

        if (!$payment) {
            return redirect()->back()->with('error', '支払い方法が見つかりません');
        }

        $paymentMethod = $payment->method;

        session([
            'paymentId' => $paymentId,
            'paymentMethod' => $paymentMethod
        ]);

        return redirect('/purchase/' . $item_id);
    }

    public function decidePurchase(PurchaseRequest $request, $item_id)
    {
        $userId = Auth::id();
        $payment_id = $request->input('payment_id');

        $soldItems = new SoldItem();
        $soldItems->item_id = $item_id;
        $soldItems->user_id = $userId;
        $soldItems->payment_id = $payment_id;
        $soldItems->save();

        return redirect('/item/' . $item_id)->with('success', '購入完了しました');
    }
}
