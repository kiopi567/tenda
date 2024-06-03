<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 追加
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // 追加
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted()
    {
        static::deleting(function ($user) {
            if ($user->isForceDeleting()) {
                // 物理削除の場合
                $user->posts()->forceDelete();
            } else {
                // 論理削除の場合
                $user->posts()->delete();
            }
        });

        static::restoring(function ($user) {
            // ユーザー復元時に投稿も復元
            $user->posts()->restore();
        });
    }

    /**
     * Get the posts for the user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
