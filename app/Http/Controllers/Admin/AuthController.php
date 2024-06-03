<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // 管理者のログイン画面表示
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // 管理者のログイン処理
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 利用者がログインしている場合、ログアウトする
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }


        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            $request->session()->put('user_type', 'admin'); // 管理者のセッションに「管理者」という単語を保存
            return redirect()->route('admin.dashboard'); // 修正
        }

        throw ValidationException::withMessages([
            'email' => [__('auth.failed')],
        ]);
    }

    // 管理者の登録画面表示
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    // 管理者の登録処理
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.users.index')->with('success', '管理者が登録されました。');
    }

    // 管理者のログアウト処理
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // 管理者TOP画面表示
    public function showAdminTop()
    {
        return view('admin.dashboard');
    }
}