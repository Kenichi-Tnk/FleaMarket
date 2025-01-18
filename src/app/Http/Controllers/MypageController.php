<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MypageController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $img_url = $user->img_url ? $user->img_url : 'storage/img/default_icon.svg';
        $sellItems = $user->items;
        $soldItems = $user->soldToItems ?? null;

        $data = [
            'user' => $user,
            'img_url' => asset($img_url),
            'sellItems' => $sellItems,
            'soldItems' => $soldItems,
        ];

        return view('mypage', $data);
    }

    public function profile()
    {
        $user = Auth::user();
        $profile = $user->profile ?? null;

        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $userForm = $request->only(['name', 'postcode', 'address', 'building']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/img/dummy', $filename);
            $user->img_url = 'storage/img/dummy/' . $filename;
            $user->save();
        }

        return redirect('/')->with('success', 'プロフィールを変更しました');
    }
}
