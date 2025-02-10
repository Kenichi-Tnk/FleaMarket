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
        $paymentMethod = session('paymentMethod', 'カード支払い');

        return view('purchase', compact('item', 'user', 'paymentMethod'));
    }

    public function address($item_id)
    {
        $user = Auth::user();

        return view('address', compact('user', 'item_id'));
    }

    public function updateAddress(Request $request, $item_id)
    {
        $user = Auth::user();
        $form = $request->except('_token');
        $isChanged = false;

        foreach ($form as $key => $value) {
            if ($user->$key != $value) {
                $isChanged = true;
            }
        }

        $user->update($form);

        if ($isChanged) {
            session()->flash('success', '配送先を変更しました');
        }

        return redirect('/purchase/' . $item_id);
    }

    public function payment($item_id)
    {
        return view('payment', compact('item_id'));
    }

    public function selectPayment(Request $request, $item_id)
    {
        $paymentMethod = $request->input('payment');

        session(['paymentMethod' => $paymentMethod]);

        return redirect('/purchase/' . $item_id);
    }

    public function decidePurchase(PurchaseRequest $request, $item_id)
    {
        $user = Auth::user();
        $item = Item::find($item_id);
        $paymentMethod = session('paymentMethod', 'カード支払い');

        $this->completePurchase($item_id, $user->id);

        return redirect()->route('purchase.success', ['item_id' => $item_id]);
    }

    public function success($item_id)
    {
        $user = Auth::user();
        $this->completePurchase($item_id, $user->id);

        return redirect('/item/' . $item_id)->with('success', '購入完了しました');
    }

    public function cancel($item_id)
    {
        return redirect('/purchase/' . $item_id)->with('error', '購入がキャンセルされました');
    }

    private function completePurchase($item_id, $user_id)
    {
        $soldItem = new SoldItem();
        $soldItem->item_id = $item_id;
        $soldItem->user_id = $user_id;
        $soldItem->save();
    }
}
