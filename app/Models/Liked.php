<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liked extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
