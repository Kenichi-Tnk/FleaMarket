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
        $img_url = $user->img_url;
        $sellItems = $user->items;
        $soldItems = $user->soldToItems ?? null;

        $data = [
            'user' => $user,
            'img_url' => $img_url,
            'sellItems' => $sellItems,
            'soldItems' => $soldItems,
        ];

        return view('mypage', $data);
    }
    public function profile()
    {
        $user = Auth::user();
        $profile = null;

        if ($user->profile) {
            $profile = $user->profile;
        }

        return view('profile', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $userForm = $request->only('name');
        unset($request->all()['_token']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/img/dummy', $filename);
            $user->img_url = '/storage/img/dummy/' . $filename;
        }

        $user->update($userForm);

        return redirect()->back();

        $profile = $user;
        $profileForm = $request->only(['profile', 'address', 'building']);

        if ($profile) {
            $profile->update($profileForm);
        } else {
            $user->profile()->create($profileForm);
        }

        return redirect()->back()->with('success', 'プロフィールを変更しました');
    }
}
