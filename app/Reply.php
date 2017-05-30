<?php

namespace App;

use App\Traits\Favorable;
use App\Traits\RecordActivity;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	use Favorable, RecordActivity;

	protected $guarded = [];
	protected $with = ['owner', 'favorites'];

	function owner()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function thread()
	{
		return $this->belongsTo('App\Thread');
	}
}
