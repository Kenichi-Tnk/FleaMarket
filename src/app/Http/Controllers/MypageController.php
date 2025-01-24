<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileRequest;

class MypageController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $img_url = $user->img_url ? asset('storage/' . $user->img_url) : asset('storage/img/default_icon.svg');
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

    public function update(ProfileRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'postcode' => 'nullable|string|max:10',
            'address' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
            'file' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->postcode = $request->input('postcode');
        $user->address = $request->input('address');
        $user->building = $request->input('building');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if($file->getClientOriginalName() !== 'default_icon.svg') {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/img/icons', $filename);
                $user->img_url = 'img/icons/' . $filename;
            }else{
                $user->img_url = 'img/default_icon.svg';
            }
        }

        $user->save();

        return redirect()->route('mypage')->with('success', 'プロフィールを変更しました');
    }
}
