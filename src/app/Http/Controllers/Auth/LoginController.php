<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $credentials = $request->only('email', 'password');

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if ($user && !$user->hasVerifiedEmail()) {
            throw ValidationException::withMessages([
                'email' => 'メールアドレスが認証完了していません。 認証メールを確認してください。'
            ]);
        }

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors([
            'email' => 'ログイン情報が登録されていません。'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
