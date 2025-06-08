<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follows';

    // フォローしているユーザー（following_id）
    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }

    // フォローされているユーザー（followed_id）
    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
}
