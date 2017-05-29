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
        Activity::create([
            'user_id' => auth()->id(),
            'type' => $this->getEventType($event),
            'subject_id' => $this->id,
            'subject_type' => get_class($this)
        ]);
    }

    protected function getEventType($event)
    {
    	$type = strtolower((new \ReflectionClass($this))->getShortName());

    	return "{$event}_{$type}";
    }

}