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
		return $this->hasMany(Schedule::class, 'schedulable_id' ,'id');
	}
}