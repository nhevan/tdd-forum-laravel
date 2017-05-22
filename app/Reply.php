<?php

namespace App;

use App\Traits\Favorable;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	use Favorable;

	protected $guarded = [];
	protected $with = ['owner', 'favorites'];

	function owner()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
