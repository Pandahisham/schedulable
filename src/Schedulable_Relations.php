<?php
namespace SouhailMerroun\Schedulable;

use SouhailMerroun\Schedulable\Schedule_Definition;
use SouhailMerroun\Schedulable\Schedule;

trait Schedulable_Relations
{
    public function schedule_definition()
	{
		return $this->morphOne(Schedule_Definition::class, 'schedulable');
	}
    
    public function schedules()
	{
		return $this->morphMany(Schedule::class, 'schedulable');
	}
    
    public static function boot()
    {
        parent::boot();
    
        static::deleted(function($task)
        {
            $task->schedules()->delete();
            $task->schedule_definition()->delete();
        });
    } 
}