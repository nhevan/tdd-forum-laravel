<?php

namespace App;

use App\User;
use App\Reply;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    function replies()
    {
    	return $this->hasMany(Reply::class)->latest();
    }

    function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }
}
