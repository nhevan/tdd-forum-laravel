<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	protected $guarded = [];

	function owner()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	function favorites()
	{
		return $this->morphMany(Favorite::class, 'favorited');
	}

	function favorite()
	{
		return $this->favorites()->create(['user_id' => auth()->id()]);
	}
}
