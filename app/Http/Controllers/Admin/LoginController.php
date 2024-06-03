<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 利用者のログイン処理
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 管理者がログインしている場合、ログアウトする
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'email' => [__('auth.failed')],
        ]);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}