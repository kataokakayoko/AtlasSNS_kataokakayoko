<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['username', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    // 自分がフォローしているユーザー
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id')->withTimestamps();
    }

    // 自分をフォローしているユーザー
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id')->withTimestamps();
    }

    // るユーザーが自分をフォローしているか確認
    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('following_id', $user->id)->exists();
    }
}
