<?php

namespace App\Traits;

use App\Favorite;

trait Favorable{
	/**
	 * defines a favorites relationship with the model
	 * @return [type] [description]
	 */
	function favorites()
	{
		return $this->morphMany(Favorite::class, 'favorited');
	}

	/**
	 * favorites a model
	 * @return [type] [description]
	 */
	function favorite()
	{
		return $this->favorites()->create(['user_id' => auth()->id()]);
	}

	/**
	 * checks if the authenticated user has favorited the current model
	 * @return boolean [description]
	 */
	public function isFavorite()
	{
		return !! $this->favorites->where('user_id', auth()->id())->count();
	}

}