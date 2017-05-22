<?php

namespace App;

use App\User;
use App\Reply;
use App\Channel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Thread extends Model
{
    protected $fillable = ['user_id', 'channel_id', 'title', 'body'];
    protected $with = ['creator', 'channel'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function (Builder $builder) {
            $builder->withCount('replies');
        });
    }

    public function replies()
    {
    	return $this->hasMany(Reply::class)
                    ->with('owner')
                    ->withCount('favorites')
                    ->latest();
    }

    public function creator()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filter)
    {
        return $filter->apply($query);
    }
}
