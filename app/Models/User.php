<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['username', 'mail', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id')->withTimestamps();
    }

    public function isFollowing($user)
    {
    $userId = $user instanceof User ? $user->id : $user;
    return $this->followings()->where('followed_id', $userId)->exists();
    }

    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('following_id', $user->id)->exists();
    }

    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }

    public function getAuthIdentifierName()
    {
    return 'mail';
    }

}
