<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ユーザー情報を編集するフォームを表示
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // ユーザー情報を更新
    public function update(Request $request, User $user)
    {
        // 入力データを検証
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // パスワードは任意
        ]);

        // ユーザー情報を更新
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    /**
     * ユーザーの論理削除
     */
    public function softDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'ユーザーを論理削除しました。');
    }

    /**
     * ユーザーの物理削除
     */
    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        // 関連する注文履歴を削除
        $user->forceDelete();

        return redirect()->route('admin.users.index')->with('success', 'ユーザーを物理削除しました。');
    }

        /**
     * ユーザーの復元
     */
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.users.index')->with('success', 'ユーザーを復元しました。');
    }

    /**
     * ユーザーの一覧を表示
     */
    public function index(Request $request)
    {
        // 検索クエリを取得
        $search = $request->input('search');

        // 検索クエリがある場合は、名前に検索クエリを含むユーザーを取得
        if (!empty($search)) {
            $users = User::withTrashed()->where('name', 'like', "%{$search}%")->get();
        }
        // 検索クエリがない場合は、全ユーザーを取得
        else {
            $users = User::withTrashed()->get();
        }

        // ユーザー一覧ビューを表示
        return view('admin.users.index', compact('users', 'search'));
    }
}