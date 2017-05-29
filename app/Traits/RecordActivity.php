<?php 

namespace App\Traits;

use App\Activity;

trait RecordActivity{
	protected static function bootRecordActivity()
	{
        static::created(function($model){
            $model->recordActivity('created');
        });
	}

	protected function recordActivity($event)
    {
    	$this->activity()->create([
    		'user_id' => auth()->id(),
            'type' => $this->getEventType($event),
		]);
    }

    public function activity()
    {
    	return $this->morphMany('App\Activity', 'subject');
    }

    protected function getEventType($event)
    {
    	$type = strtolower((new \ReflectionClass($this))->getShortName());

    	return "{$event}_{$type}";
    }

}