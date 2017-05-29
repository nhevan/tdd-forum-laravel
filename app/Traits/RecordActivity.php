<?php 

namespace App\Traits;

use App\Activity;

trait RecordActivity{
	protected static function bootRecordActivity()
	{
		if (auth()->guest()) return;

		foreach (static::getActivitiesToRecord() as $activity) {
			static::$activity(function($model) use($activity){
	            $model->recordActivity($activity);
	        });
		}
	}

	protected static function getActivitiesToRecord()
	{
		return ['created'];
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