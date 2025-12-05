<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function followingUser()
    {
        return $this->belongsTo(User::class, 'following_to_users_id');
    }

    
}
