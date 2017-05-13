<?php

namespace App;

use App\User;
use App\Reply;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function replies()
    {
    	return $this->hasMany(Reply::class)->latest();
    }

    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function path()
    {
    	return '/threads/' . $this->id;
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
}
