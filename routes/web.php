<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\Testcontroller;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;


// Authの利用のため
use Illuminate\Support\Facades\Auth;
//use App\Http\Controllers\GoodsController;
//use App\Http\Controllers\CategoriesController;
use Illuminate\Http\Request;
//use App\Http\Controllers\OrderdetailController;


use App\Http\Controllers\Admin\AuthController;
// 管理者用のルート
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.login');
    })->name('admin.login');

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth.admin')->group(function () {
        Route::get('dashboard', [AuthController::class, 'showAdminTop'])->name('admin.dashboard');
        Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('users/create', [AuthController::class, 'showRegisterForm'])->name('admin.users.create');
        Route::post('users', [AuthController::class, 'register'])->name('admin.users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('users/{user}/softDelete', [UserController::class, 'softDelete'])->name('admin.users.softDelete');
        Route::delete('users/{user}/forceDelete', [UserController::class, 'forceDelete'])->name('admin.users.forceDelete');
        Route::post('users/{user}/restore', [UserController::class, 'restore'])->name('admin.users.restore');
    });
});









//何なのかよくわからない。
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/test',[TestController::class,'test'])
->name('test');




// トップページ
Route::get('/', function () {
    return view('welcome');
});

// ダッシュボード
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// 認証済みユーザー向けのルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // プロフィール編集フォーム表示
    Route::get('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.image'); // プロフィール画像変更
    Route::patch('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.image'); // プロフィール画像変更
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // プロフィール更新
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // プロフィール削除
});

require __DIR__.'/auth.php';
