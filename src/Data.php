<?php
namespace SouhailMerroun\Schedulable;

use SouhailMerroun\Schedulable\Schedule;

trait Data
{
    public function getPendingSchedules()
    {
        return $this->schedules()->whereNull('state')->whereNull('ended_at')->get();
    }
    
    public function getAccomplishedSchedules()
    {
        return $this->schedules()->where('state', 1)->whereNotNull('ended_at')->get();
    }
    
    public function getAbortedSchedules()
    {
        return $this->schedules()->where('state', -1)->whereNotNull('ended_at')->get();
    }
}