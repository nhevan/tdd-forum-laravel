<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	protected $guarded = [];
	protected $with = ['owner', 'favorites'];

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

	public function isFavorite()
	{
		return !! $this->favorites->where('user_id', auth()->id())->count();
	}
}
